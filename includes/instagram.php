<?php

  class Instagram_API_Endpoints {

    protected $api = 'https://api.instagram.com/v1';

    var $limit     = 10;
    var $max_limit = 25;

    public function __construct() {
      add_action( 'init', array( $this, 'add_endpoint' ), 0 );
      add_filter( 'query_vars', array( $this, 'query_vars' ), 0);
      add_action( 'parse_request', array($this, 'parse_request'), 0 );
    }

    public function add_endpoint() {
      add_rewrite_rule( '^api/photos/?([0-9]+)?/?', 'index.php?api=instagram&limit=$matches[1]', 'top' );
    }

    public function query_vars( $vars ) {
      $vars[] = 'api';
      $vars[] = 'limit';
      return $vars;
    }

    public function parse_request() {
      global $wp;

       if ( isset( $wp->query_vars['api'] ) && $wp->query_vars['api'] === 'instagram' ) {
        if ( false === ( $data = get_transient( 'instagram_latest_photos' ) ) ) {
          $data = $this->getLatest( $wp->query_vars['limit'] );

          $seconds = ot_get_option( 'instagram-cache' );
          $seconds = ! isset( $seconds ) ? 600 : $seconds;

          set_transient( 'instagram_latest_photos', $data, $seconds );
        }
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $data;
        exit;
      }
    }

    public function getLatest( $limit ) {
      $this->user_id   = ot_get_option( 'instagram-user-id' );
      $this->client_id = ot_get_option( 'instagram-client-id' );

      if ( $this->client_id && $this->user_id ) {
        $limit = !$limit ? $this->limit : $limit;
        $limit = $limit > $this->max_limit ? $this->max_limit : $limit;

        $query = array(
          'count'     => $limit,
          'client_id' => $this->client_id
        );

        $endpoint     = '/users/' . $this->user_id . '/media/recent';
        $querystring = '?' . http_build_query( $query );

        try {
          $curl_connection = curl_init( $this->api . $endpoint . $querystring );
          curl_setopt( $curl_connection, CURLOPT_CONNECTTIMEOUT, 30 );
          curl_setopt( $curl_connection, CURLOPT_RETURNTRANSFER, true );
          curl_setopt( $curl_connection, CURLOPT_SSL_VERIFYPEER, false );

          $result = curl_exec( $curl_connection );
          curl_close( $curl_connection );

          $result = json_decode( $result, true );
          $data   = json_encode( $result['data'], JSON_FORCE_OBJECT );

          return $data;
        } catch( Exception $e ) {
          return $e->getMessage();
        }
      }
    }
  }

?>
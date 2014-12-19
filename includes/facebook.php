<?php

  class Facebook_API_Endpoints {

    protected $api = 'https://graph.facebook.com/v2.2';

    var $limit     = 10;
    var $max_limit = 25;

    public function __construct() {
      add_action( 'init', array( $this, 'add_endpoint' ), 0 );
      add_filter( 'query_vars', array( $this, 'query_vars' ), 0);
      add_action( 'parse_request', array($this, 'parse_request'), 0 );
    }

    public function add_endpoint() {
      add_rewrite_rule( '^api/statuses/?([0-9]+)?/?', 'index.php?api=facebook&limit=$matches[1]', 'top' );
    }

    public function query_vars( $vars ) {
      $vars[] = 'api';
      $vars[] = 'limit';
      return $vars;
    }

    public function parse_request() {
      global $wp;

      if ( isset( $wp->query_vars['api'] ) && $wp->query_vars['api'] === 'facebook' ) {
        if ( false === ( $data = get_transient( 'facebook_latest_statuses' ) ) ) {
          $data = $this->getLatest( $wp->query_vars['limit'] );

          $seconds = ot_get_option( 'facebook-cache' );
          $seconds = ! isset( $seconds ) ? 600 : $seconds;

          set_transient( 'facebook_latest_statuses', $data, $seconds );
        }
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $data;
        exit;
      }
    }

    public function getLatest( $limit ) {
      $this->token    = ot_get_option( 'facebook-access-token' );
      $this->page_id  = ot_get_option( 'facebook-page-id' );

      if ( $this->token && $this->page_id ) {
        $limit = !$limit ? $this->limit : $limit;
        $limit = $limit > $this->max_limit ? $this->max_limit : $limit;

        $query = array(
          'limit'        => $limit,
          'fields'       => 'caption,from,icon,id,link,message,name,object_id,picture,status_type,type',
          'access_token' => $this->token
        );

        $endpoint    = '/' . $this->page_id . '/promotable_posts';
        $querystring = '?' . http_build_query( $query );

        try {
          $curl_connection = curl_init( $this->api . $endpoint . $querystring );
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
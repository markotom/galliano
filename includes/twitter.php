<?php

  class Twitter_API_Endpoints {

    protected $api = 'https://api.twitter.com/1.1';

    var $limit     = 10;
    var $max_limit = 25;

    public function __construct() {
      add_action( 'init', array( $this, 'add_endpoint' ), 0 );
      add_filter( 'query_vars', array( $this, 'query_vars' ), 0);
      add_action( 'parse_request', array($this, 'parse_request'), 0 );
    }

    public function add_endpoint() {
      add_rewrite_rule( '^api/tweets/?([0-9]+)?/?', 'index.php?api=twitter&limit=$matches[1]', 'top' );
    }

    public function query_vars( $vars ) {
      $vars[] = 'api';
      $vars[] = 'limit';
      return $vars;
    }

    public function parse_request() {
      global $wp;

       if ( isset( $wp->query_vars['api'] ) && $wp->query_vars['api'] === 'twitter' ) {
        if ( false === ( $data = get_transient( 'twitter_latest_tweets' ) ) ) {
          $data = $this->getLatest( $wp->query_vars['limit'] );

          $seconds = ot_get_option( 'twitter-cache' );
          $seconds = ! isset( $seconds ) ? 600 : $seconds;

          set_transient( 'twitter_latest_tweets', $data, $seconds );
        }
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $data;
        exit;
      }
    }

    public function getLatest( $limit ) {
      $this->token           = ot_get_option( 'twitter-access-token' );
      $this->token_secret    = ot_get_option( 'twitter-access-token-secret' );
      $this->consumer_key    = ot_get_option( 'twitter-consumer-key' );
      $this->consumer_secret = ot_get_option( 'twitter-consumer-secret' );
      $this->screen_name     = ot_get_option( 'twitter-screen-name' );

      if ( $this->token && $this->token_secret && $this->consumer_key && $this->consumer_secret ) {
        $limit = !$limit ? $this->limit : $limit;
        $limit = $limit > $this->max_limit ? $this->max_limit : $limit;

        $query = array(
          'count'       => $limit,
          'screen_name' => $this->screen_name
        );

        $endpoint     = '/statuses/user_timeline.json';
        $querystring = '?' . http_build_query( $query );

        $oauth = array(
          'oauth_consumer_key'     => $this->consumer_key,
          'oauth_token'            => $this->token,
          'oauth_nonce'            => (string) mt_rand(),
          'oauth_timestamp'        => time(),
          'oauth_signature_method' => 'HMAC-SHA1',
          'oauth_version'          => '1.0'
        );

        $arr = array_merge( $oauth, $query );
        asort( $arr );
        ksort( $arr );
        $base = 'GET&' . rawurlencode( $this->api . $endpoint ) . '&' . rawurlencode( http_build_query( $arr ) );
        $key  = $this->consumer_secret . '&' . $this->token_secret;
        $oauth[ 'oauth_signature' ] = rawurlencode( base64_encode( hash_hmac( 'sha1', $base, $key, true ) ) );
        $auth = 'OAuth ' . urldecode( http_build_query( $oauth, '', ', ' ) );

        try {
          $curl_connection = curl_init( $this->api . $endpoint . $querystring );
          curl_setopt( $curl_connection, CURLOPT_HTTPHEADER, array("Authorization: $auth") );
          curl_setopt( $curl_connection, CURLOPT_RETURNTRANSFER, true );
          curl_setopt( $curl_connection, CURLOPT_SSL_VERIFYPEER, false );

          $result = curl_exec( $curl_connection );
          curl_close( $curl_connection );

          $result = json_decode( $result, true );
          $data   = json_encode( $result, JSON_FORCE_OBJECT );

          return $data;
        } catch( Exception $e ) {
          return $e->getMessage();
        }
      }
    }
  }

?>
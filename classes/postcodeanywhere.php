<?php defined('SYSPATH') OR die('No direct access allowed.');

class Postcodeanywhere {

	protected $_config;

	protected static $_instance;

	public static function instance()
	{
		if ( ! isset(Postcodeanywhere::$_instance))
		{
			$config = Kohana::$config->load('postcodeanywhere');

            Postcodeanywhere::$_instance = new Postcodeanywhere($config);
		}
		
		return Postcodeanywhere::$_instance;
	}
	
	private function __construct($config)
	{
		$this->_config = $config;
	}

    private function _request($service, $parameters)
    {
        $parameters = array_merge(array('Key' => $this->_config['key']), $parameters);

        $request = 'http://services.postcodeanywhere.co.uk/'.$service.URL::query($parameters);

        $context = stream_context_create(array(
            'http' => array('ignore_errors' => true)
        ));

        $response = file_get_contents($request, FALSE, $context);

        return json_decode($response);
    }

    public function Geocoding_International_ReverseGeocode($request)
    {
        $service = 'Geocoding/International/ReverseGeocode/v1.00/json3.ws';

        $response = $this->_request($service, $request);

        $return = $response;

        return $return;
    }

}

<?php
/**
 * Format class
 *
 * Help convert between various formats such as XML, JSON, CSV, etc.
 *
 * @author  	Phil Sturgeon
 * @license		http://philsturgeon.co.uk/code/dbad-license
 */
class Format {

	// Array to convert
	protected $_data = array();

	// View filename
	protected $_from_type = null;

	/**
	 * Returns an instance of the Format object.
	 *
	 *     echo $this->format->factory(array('foo' => 'bar'))->to_xml();
	 *
	 * @param   mixed  general date to be converted
	 * @param   string  data format the file was provided in
	 * @return  Factory
	 */
	public function factory($data, $from_type = null)
	{
		// Stupid stuff to emulate the "new static()" stuff in this libraries PHP 5.3 equivalent
		$class = __CLASS__;
		return new $class($data, $from_type);
	}

	/**
	 * Do not use this directly, call factory()
	 */
	public function __construct($data = null, $from_type = null)
	{
		get_instance()->load->helper('inflector');

		// If the provided data is already formatted we should probably convert it to an array
		if ($from_type !== null)
		{
			if (method_exists($this, '_from_' . $from_type))
			{
				$data = call_user_func(array($this, '_from_' . $from_type), $data);
			}

			else
			{
				throw new Exception('Format class does not support conversion from "' . $from_type . '".');
			}
		}

		$this->_data = $data;
	}

	// Format XML for output
	public function to_xml_from_xml($data = null, $structure = null, $basenode="xml")
	{
		if ($data === null and ! func_num_args())
		{
			$data = $this->_data;
		}

		if ($structure === null)
		{
			$structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
		}

		foreach ($data as $key => $value)
		{

			//change false/true to 0/1
			if(is_bool($value))
			{
				$value = (int) $value;
			}

			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				$key = $basenode;
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

			// if there is another array found recursively call this function
			if (is_array($value) || is_object($value))
			{
				$node = $structure->addChild($key);

				// recursive call.
				$this->to_xml_from_xml($value, $node, $key);
			}

			else
			{
				// add single node.
				$value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");

				$structure->addChild($key, $value);
			}
		}
		return $structure->asXML();
	}

	// Format XML for output
	public function to_xml_from_csv($data = null, $structure = null, $basenode = 'xml')
	{
		if ($data === null and ! func_num_args())
		{
			$data = $this->_data;
		}

		if ($structure === null)
		{
			$structure = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$basenode />");
		}

		foreach ($data as $key => $value)
		{

			//change false/true to 0/1
			if(is_bool($value))
			{
				$value = (int) $value;
			}

			// no numeric keys in our xml please!
			if (is_numeric($key))
			{
				// make string key...
				$key = (singular($basenode) != $basenode) ? singular($basenode) : 'item';
			}

			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z_\-0-9]/i', '', $key);

			// if there is another array found recursively call this function
			if (is_array($value) || is_object($value))
			{
				$node = $structure->addChild($key);

				// recursive call.
				$this->to_xml_from_csv($value, $node, $key);
			}

			else
			{
				// add single node.
				$value = htmlspecialchars(html_entity_decode($value, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, "UTF-8");

				$structure->addChild($key, $value);
			}
		}

		return $structure->asXML();
	}
	
	public function to_html_from_xml() {
		$data = $this->_data;

		$result = array(
			'' => '<td></td>'
		);
		foreach($data as $sub) {
			$result = array_merge($result, $sub);
		}        
		$headings = array_keys($result);

		$ci = get_instance();
		$ci->load->library('table');

		$ci->table->set_heading($headings);

		foreach ($data as $row)
		{
			$ci->table->add_row($row);
		}

		return $ci->table->generate();
	}
}



/* End of file format.php */

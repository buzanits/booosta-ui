<?php
namespace booosta\ui;
\booosta\Framework::init_module('ui');

abstract class UI extends \booosta\base\Module
{
  use moduletrait_ui;

  protected $id;

  public function __construct($id = null)
  {
    parent::__construct();

    $this->id = $id;
  }

  public function get_id() { return $this->id; }
  public function set_id($id) { $this->id = $id; }
  public function print_html() { print $this->get_html(); }

  public function get_html_includes($libpath = '') {}     // Include statements for HTML page (eg. js-files)

  public function get_html()
  {
    $js = $this->get_js();
    $html = $this->get_htmlonly();

    if($js):
      if(is_object($this->topobj) && method_exists($this->topobj, 'add_javascript')):
        $this->topobj->add_javascript($js);
      else:
        $html = "<script type='text/javascript'>\n$js\n</script>\n$html";
      endif;
    endif;

    return $html;
  }

  abstract public function get_js();
  abstract public function get_htmlonly();
}

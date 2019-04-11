<?php
/**
 * Created by PhpStorm.
 * User: DIGITAL
 * Date: 28/03/2019
 * Time: 11:31
 */

namespace YamiTec\Interfaces;


interface Renderer
{
    public function __construct($string = false, $template = './resources/templates');

    public function replace($is, $to);

    public function setData($params = []);

    public function setTemplate($template = 'Module/template.sample');

    public function globalVar($varName, $value = []);

    public function render();
}

abstract class RendererInterface implements Renderer
{
    private $data = [];
    private $template = null;
    private $tplModule = null;
    private $tpl = null;
    private $string = null;

    public function __construct($string = false, $template = "../resources/templates/")
    {
        $this->string = $string;
        $this->template = realpath($_SERVER['DOCUMENT_ROOT'] . "/" . $template);
        $loader = ($this->string) ? new \Twig_Loader_Array(array()) : new \Twig_Loader_Filesystem($this->template);
        $this->tpl = new \Twig_Environment($loader);
        $this->tpl->addExtension(new \Twig_Extension_StringLoader());
        //$this->str = new \Twig_Environment(new \Twig_loader_String());
    }

    public function setTemplate($tplModule = 'Module/template.sample')
    {
        // TODO: Implement setTemplate() method.
        $this->tplModule = $tplModule;
        return $this;
    }

    public function setData($params = [])
    {
        // TODO: Implement setData() method.
        $this->data = $params;
        return $this;
    }

    public function replace($is, $to)
    {
        // TODO: Implement replace() method.
        $this->tplModule = str_replace($is, $to, $this->tplModule);
        return $this;
    }

    public function globalVar($varName, $value = [])
    {
        // TODO: Implement globalVar() method.
        $this->tpl->addGlobal($varName, $value);
        return $this;
    }

    public function render()
    {
        // TODO: Implement render() method.
        try {
            if ($this->string) {
                $tpl = $this->tpl->createTemplate($this->tplModule);
                return $tpl->render($this->data);
            } else {
                return $this->tpl->render($this->tplModule, $this->data);
            }

        } catch (\Twig_Error_Loader $e) {
            echo $e->getMessage();
            return false;
        }catch(\Twig_Error_Runtime $e) {
            echo $e->getMessage();
            return false;
        } catch (\Twig_Error_Syntax $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function __templateToString($tplModule)
    {
        $this->tplModule = file_get_contents($this->template.'/'.$tplModule);
        $this->string = true;
        return $this;
    }
}
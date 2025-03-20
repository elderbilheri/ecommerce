<?php 

    namespace Hcode;

    use Rain\Tpl;

    class Page {

        private $tpl;
        private $options = [];
        private $defaults = [
            "header" => true,
            "footer" => true,
            "data" => []
        ];

        // Método construtor
        public function __construct($opts = array(), $tpl_dir = "/views/")
        {
            // Faz o merge dos arrays, caso não tenha nenhum array o "deaults será utilizado, se não, valerá o que vier do parâmetro.
            $this->options = array_merge($this->defaults, $opts);

            // config
            $config = array(
                "tpl_dir"    => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
                "cache_dir"  => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
                "debug"      => false // set to false to improve the speed
            );

            Tpl::configure($config);

            $this->tpl = new Tpl;

            $this->setData($this->options['data']);

            if ($this->options['header'] === true) $this->tpl->draw("header"); // Método do TPL que que desenha/cria o layout.
        }

        // Método que seta os dados para o assign do TPL.
        public function setData($data = array()) {

            foreach ($data as $key => $value) {
                $this->tpl->assign($key, $value);
            }

        }
 
        // Método para setar o TPL e criar as páginas.
        public function setTpl($name, $data = [], $returnHTML = false) {
            $this->setData($this->options);

            return $this->tpl->draw($name, $returnHTML);
        }

        // Método destrutor
        public function __destruct()
        {
            if ($this->options['footer'] === true) $this->tpl->draw("footer");
        }

    }

?>
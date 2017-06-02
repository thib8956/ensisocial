<?php

class form{
    private $data;
    private $surround='div';
    private $button;

    /**
     * form constructor.
     * @param $data array regroupe tous les champs du formulaire
     *        $button donne le texte afficher sur le boutton
     */
    public function __construct($data, $button){
        $this->data=$data;
        $this->button=$button;
    }

    /**
     * @param $html
     */
    private function surround($html){
        return "<{$this->surround} class=\"form-group\" >{$html}</{$this->surround}>";
    }

    /**
     * @param $index
     * @return string
     *     */
    private function getValue($index){
        return isset($this->data[$index]) ? $this->data[$index]:null;
    }

    /**
     * @param $name
     * @param $type
     * @param $display
     * @param $option
     * @return string
     */
    public function inputsection($name, $type, $display, $option){

        $section='<label for="'.$display.'" class="control-label"></label>
						<select name="'.$name.'" class="form-control">';
        foreach($option as $key =>$value){
            $section = $section . '<option value = ' . $key . '>' . $option[$key] . '</option >';
        }

						$section=$section.'</select>';
        return $this->surround($section);

    }


    /**
     * @param $index
     * @return string
     */
    private function getType($index){
        return isset($this->data[$index]) ? gettype($this->data[îndex]):null;
    }


    /**
     * @param $name
     * @param $type
     * @param $display
     * @param bool $mandatory
     * @return string
     */
    public function inputfield($name, $type, $display, $mandatory=false){
        if ($mandatory==true) {
            return $this->surround(
                '<label for="'.$name.'" class="control-label">'.$display.'<span class="asteriskField">*</span></label>
						<input type="'.$type.'" name="'.$name.'" class="form-control">');
        }
        return $this->surround(
            '<label for="'.$name.'" class="control-label">'.$display.'</label>
						<input type="'.$type.'" name="'.$name.'" class="form-control">');

    }

    /**
     * @return string retourn la commande html pour créer le bouton du formulaire
     */
    public function submit($display){
        return $this->surround('<input type="submit" value ="'.$display.'" name="'.$this->button.'" class="btn btn-primary">');
    }
}

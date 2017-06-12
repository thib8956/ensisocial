<?php


class form{
    private $data;
    private $surround = 'div';
    private $button;

    /**
     * form constructor.
     * @param $data array regroupe tous les champs du formulaire
     *        $button donne le texte afficher sur le boutton
     */
    public function __construct($data,$button){
        $this->data = $data;
        $this->button = $button;
    }

    /**
     * @param $html
     */
    private function surround($html, $class="form-group"){
        return "<{$this->surround} class=".$class." >{$html}</{$this->surround}>";
    }

    /**
     * @param $index
     * @return string
     */
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
    public function inputsection($name, $type, $display, $option, $classlabel="control-label", $classselect="form-control"){
        $section='<label for="'.$display.'" class="'.$classlabel.'"></label>
        <select name="'.$name.'" class="'.$classselect.'">';
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
    public function inputfield($name, $type, $display, $mandatory=FALSE, $classlabel="control-label", $classselect="form-control", $glyphicon=FALSE){
        $label = '<label for="'.$name.'" class="'.$classlabel.'">'.$display;
        if ($mandatory) $label .= '<span class="asteriskField">*</span>';
        $label .= '</label>';

        $input = '';
        if ($glyphicon){
            $input .= '<span class="input-group-addon">';
            $input .= '<span class="glyphicon '.$glyphicon.'"></span>';
            $input .= '</span>';
        }
        $input .= '<input name="'.$name.'" type="'.$type.'" class="'.$classselect.'">';

        if ($glyphicon) $input = $this->surround($input, 'input-group');
        return $this->surround($label . $input);
    }

    public function inputtextarea($name, $display, $rows, $cols, $classlabel="control-labe", $classarea="form-control"){
        return $this->surround('
          <label for="'.$name.'" class='.$classlabel.'>'.$display.'</label>
          <textarea name='.$name.' class="'.$classarea.'" rows="'.$rows.'" cols="'.$cols.'"></textarea>');

   }

   public function inputradiobutton($name,$value,$class){
        $but="";
        foreach ($value as $key => $value) {
            $but=$but.'<input type=radio name="'.$name.'" value="'.$key.' class='.$class.'ckecked >'.$value.' <br>';
        }
        return $this->surround($but);
   }

   /**
    * Add a file input to the form.
    * @param  string $name        <input name=[...]>
    * @param  string $display     Display name of the label.
    */
   public function inputfile($name, $display, $classlabel="control-label", $classselect=""){
        return $this->surround('
            <label for="'.$name.'" class='.$classlabel.'>'.$display.'</label>
            <input id="'.$name.'" type="file" name="'.$name.'" class="file "'.$classselect.'>');
   }

    /**
     * @return string retourn la commande html pour créer le bouton du formulaire
     */
    public function submit($display){
        return $this->surround('<input type="submit" value ="'.$display.'" name="'.$this->button.'" class="btn btn-primary">');
    }
}

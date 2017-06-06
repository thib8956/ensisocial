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
    private function surround($html,$class="form-group",$id=""){
        return "<{$this->surround} class=".$class."id=".$id." >{$html}</{$this->surround}>";
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
    public function inputsection($name, $type, $display,$option,$classlabel="control-label",$classselect="form-control",$id=""){
        if ($id==NULL){
            $section='<label for="'.$display.'" class="'.$classlabel.'"></label>
            <select name="'.$name.'" class="'.$classselect.'" id="'.$id.'">';
                foreach($option as $key =>$value){
                    $section = $section . '<option value = ' . $key . '>' . $option[$key] . '</option >';
                }

                $section=$section.'</select>';
                return $this->surround($section);
            }

        }


    /**
     * @param $name
     * @param $type
     * @param $display
     * @param bool $mandatory
     * @return string
     */
    public function inputfield($name, $type, $display, $mandatory=false,$classlabel="control-label",$classselect="form-control",$id=""){
        if ($mandatory==true) {
            return $this->surround(
                '<label for="'.$name.'" class="'.$classlabel.'">'.$display.'<span class="asteriskField">*</span></label>
                <input type="'.$type.'" name="'.$name.'" class="'.$classselect.'" id='.$id.'>');
        }
        return $this->surround(
            '<label for="'.$name.'" class="control-label">'.$display.'</label>
            <input type="'.$type.'" name="'.$name.'" class="form-control" id="'.$id.'">');

    }

    public function inputtextarea($name, $display, $rows, $cols, $classlabel="control-labe", $classarea="form-control",$id=""){
        return $this->surround('
          <label for="'.$name.'" class='.$classlabel.'>'.$display.'</label>
          <textarea name='.$name.' class="'.$classarea.'" rows="'.$rows.'" cols="'.$cols.'" id="'.$id.'"></textarea>');

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
    public function submit($display,$class="btn btn-primary",$id=""){
        return $this->surround('<input type="submit" value ="'.$display.'" name="'.$this->button.'" class="'.$class.'" id="'.$id.'">');
    }
}

<?php

  namespace App\Admin;

  class Formulaire {
    public static function label($text, $for ="", $classNames = "form-label") {
      return <<<HTML
        <label for={$for} class={$classNames}>
          {$text}
        </label>
      HTML;
    }

    public static function input($name, $type = "text", $value = "", $id = "", $classNames = "form-control") {
      return <<<HTML
        <input 
          name={$name}
          type={$type}
          class={$classNames} 
          value={string($value)}
          id={$id} />
      HTML;
    }

    public static function disabledInput($name, $type = "text", $value = "", $id = "", $classNames = "form-control") {
      return <<<HTML
        <input 
          name={$name}
          type={$type}
          class={$classNames} 
          id={$id}
          disabled />
      HTML;
    }

    public static function textarea($name, $classNames = "", $value = "", $id="") {
      return <<<HTML
        <textarea name={$name} class={$classNames}>
          {$value}
        </textarea>
      HTML;
    }

    public static function submit($value, $classNames = "btn btn-primary mt-3") {
      return <<<HTML
        <button type={$type} name={$name} class={$classNames}>
          {$value}
        </button>
      HTML;
    }
  }
<?php


namespace app\core\html;


class FormField
{
    private string $id;
    private string $name;
    private string $class;
    private string $labelName;
    private array $param;
    private string $type = 'text';

    /**
     * FormField constructor.
     * @param string $id
     * @param string $name
     * @param string $class
     * @param string $labelName
     * @param string $param
     */
    public function __construct(string $id, string $name, string $class, string $labelName, string $type = 'text', array $param = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->class = $class;
        $this->labelName = $labelName;
        $this->param = $param;
        $this->type = $type;

    }


    public function __toString(): string
    {
        $validClass = !empty($this->param['errors'][$this->name . "Err"]) ? "is-invalid" : '';
        $invalidFeedbackText = $this->param['errors'][$this->name . "Err"];
        return <<<STRING
        <div class="form-group">
            <label for="$this->id">$this->labelName:<sup>*</sup></label>
            <input type="$this->type" name="$this->name" id="$this->id" class="$validClass form-control form-control-lg" value="{$this->param['name']}">
            <span class='invalid-feedback'>$invalidFeedbackText</span>
        </div>
STRING;
    }

}
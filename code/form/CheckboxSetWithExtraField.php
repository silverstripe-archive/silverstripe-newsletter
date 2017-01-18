<?php
/**
 * @package newsletter
 */

class CheckboxSetWithExtraField extends CheckboxSetField
{

    public $extra = array();
    public $extraValue = array();

    // can be two-D array eg. array("Email"=>arrray("Value","Reqired"));
    public $cellDisabled = array();
    public $tragable = true;

    /**
     * Creates a new optionset field.
     * @param name The field name
     * @param title The field title
     * @param source An map of the dropdown items
     * @param extra An map of label (DBField's name) => classname (DBField's class) for extra field
     * @param value The current value
     * @param extraValue The current extraValues
     * @param form The parent form
     */
    public function __construct(
        $name,
        $title = "",
        $source = array(),
        $extra = array(),
        $value = "",
        $extraValue = array(),
        $form = null
    ) {
        if (!empty($extra)) {
            $this->extra = $extra;
        }
        if (!empty($extraValue)) {
            $this->extraValue = $extraValue;
        }
        parent::__construct($name, $title, $source, $value, $form);
    }

    public function setCellDisabled($cellDisabled)
    {
        $this->cellDisabled = $cellDisabled;
    }

    /**
     * Sets the template to be rendered with
     */
    public function FieldHolder($properties = array())
    {
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
        Requirements::javascript(NEWSLETTER_DIR . '/thirdparty/jquery-tablednd/jquery.tablednd.0.7.min.js');
        Requirements::javascript(NEWSLETTER_DIR . '/javascript/CheckboxSetWithExtraField.js');
        Requirements::css(NEWSLETTER_DIR . '/css/CheckboxSetWithExtraField.css');

        return parent::FieldHolder($properties);
    }

    /**
     * @todo Explain different source data that can be used with this field,
     * e.g. SQLMap, DataObjectSet or an array.
     *
     * @todo Should use CheckboxField FieldHolder rather than constructing own markup.
     */
    public function Field($properties = array())
    {
        $source = $this->source;
        $values = $this->value;
        // Get values from the join, if available
        if (is_object($this->form)) {
            $record = $this->form->getRecord();
            if (!$values && $record && $record->hasMethod($this->name)) {
                $funcName = $this->name;
                $join = $record->$funcName();
                if ($join) {
                    foreach ($join as $joinItem) {
                        $values[] = $joinItem->ID;
                    }
                }
            }
        }

        // Source is not an array
        if (!is_array($source) && !is_a($source, 'SQLMap')) {
            if (is_array($values)) {
                $items = $values;
            } else {
                // Source and values are DataObject sets.
                if ($values && is_a($values, 'DataList')) {
                    foreach ($values as $object) {
                        if (is_a($object, 'DataObject')) {
                            $items[] = $object->ID;
                        }
                    }
                } elseif ($values && is_string($values)) {
                    $items = explode(',', $values);
                    $items = str_replace('{comma}', ',', $items);
                }
            }
        } else {
            // Sometimes we pass a singluar default value thats ! an array && !DataObjectSet
            if (is_a($values, 'DataList') || is_array($values)) {
                $items = $values;
            } else {
                $items = explode(',', $values);
                $items = str_replace('{comma}', ',', $items);
            }
        }

        if (is_array($source)) {
            unset($source['']);
        }

        $odd = 0;
        $options = '';

        if ($source == null) {
            $source = array();
            $options = sprintf(
                "<tr><td>%s</td></tr>",
                _t('Newsletter.NoOptions', 'No options available')
            );
        } else {
            $header = "<thead><tr><th></th>";
            $footer = "<tfoot><tr><td></td>";
            if (!empty($this->extra)) {
                foreach ($this->extra as $label=>$type) {
                    $fieldLabel = FormField::name_to_label($label);
                    $header .= "<th>$fieldLabel</th>";
                    $footer .= "<td>$fieldLabel</td>";
                }
            }

            //add a column for drag&drop icon
            if ($this->tragable) {
                $header .= "<th></th>";
                $footer .= "<td></td>";
            }

            $header .= "</tr></thead>";
            $footer .= "</tr></tfoot>";

            foreach ($source as $index => $item) {
                if (is_a($item, 'DataObject')) {
                    $key = $item->ID;
                    $value = $item->Title;
                } else {
                    $key = $index;
                    $value = $item;
                }

                $odd = ($odd + 1) % 2;
                $extraClass = $odd ? 'odd' : 'even';
                $extraClass .= ' val' . str_replace(' ', '', $key);
                $itemID = $this->id() . '_' . preg_replace('/[^a-zA-Z0-9]+/', '', $key);
                $checked = '';
                if (isset($items)) {
                    $checked = (in_array($key, $items)) ? ' checked="checked"' : '';
                }

                $disabled = isset($this->cellDisabled[$key]) &&
                        in_array('Value', $this->cellDisabled[$key]) ? ' disabled="disabled"' : '';
                $options .= "<tr id=\"tr_$itemID\" class=\"$extraClass\">
				<td>
				<input id=\"$itemID\" name=\"$this->name[$key][Value]\"
					type=\"checkbox\" value=\"$key\"$checked $disabled class=\"checkbox\" /> $value
				</td>";

                if (!empty($this->extraValue)) {
                    foreach ($this->extraValue as $label => $val) {
                        if ($val) {
                            $extraValue[$label] = Convert::json2array($val);
                        }
                    }
                }

                if (!empty($this->extra)) {
                    foreach ($this->extra as $label => $fieldType) {
                        $value = "";
                        if (isset($extraValue[$label][$key])) {
                            $value = $extraValue[$label][$key];
                        }
                        $dbField = DBField::create_field($fieldType, $value, $this->name."[".$key."][".$label."]");
                        $extraField = $dbField->scaffoldFormField($this->name."[".$key."][".$label."]");
                        $extraField -> setValue($value);
                        if (isset($this->cellDisabled[$key]) && in_array($label, $this->cellDisabled[$key])) {
                            $extraField->setDisabled(true);
                        }
                        $options .= "<td>".$extraField->Field()."</td>";
                    }
                }
                $options .= "<td class=\"dragHandle\"></td>";
                $options .= "</tr>";
            }
        }

        return "<table id=\"{$this->id()}\" class=\"optionset checkboxsetwithextrafield {$this->extraClass()}\">".
                $header.$footer.$options."</table>\n";
    }

    /**
     * Return the CheckboxSetField value as an array
     * selected item keys.
     *
     * @return string
     */
    public function dataValue()
    {
        $value = ArrayLib::invert($this->value);
        if (isset($value) && is_array($value)) {
            foreach ($value as $key=>$items) {
                foreach ($items as $k=>$v) {
                    if ($v) {
                        $filtered[$key][$k] = str_replace(", ", "{comma}", $v);
                    }
                }
            }

            if (isset($filtered)) {
                return Convert::array2json($filtered);
            } else {
                return '';
            }
        }

        return '';
    }

    public function saveInto(DataObjectInterface $record)
    {
        $fieldname = $this->name ;
        $this->value['Email']['Value'] = 'Email';
        $this->value['Email']['Required'] = 1;
        $value = ArrayLib::invert($this->value);
        if ($fieldname && $record && ($record->has_many($fieldname) || $record->many_many($fieldname))) {
            $idList = array();
            if ($value) {
                foreach ($value['Value'] as $id => $bool) {
                    if ($bool) {
                        $idList[] = $id;
                    }
                }
            }
            $record->$fieldname()->setByIDList($idList);
        } elseif ($fieldname && $record) {
            if ($value) {
                if (is_array($value)) {
                    foreach ($value as $k => $items) {
                        if (is_array($items)) {
                            foreach ($items as $key => $val) {
                                if (!$val) {
                                    unset($value[$k][$key]);
                                } else {
                                    if ($k == 'Value') {
                                        $value[$k][$key] = str_replace(", ", "{comma}", $val);
                                    }
                                }
                            }
                        }
                    }
                }
                foreach ($value as $k => $v) {
                    if ($k == 'Value') {
                        $record->$fieldname = implode(",", $v);
                    } else {
                        $record->$k = Convert::array2json($v);
                    }
                }
            } else {
                $record->$fieldname = '';
            }
        }
    }

    public function setValue($value, $obj = null)
    {
        // If we're not passed a value directly, we can look for it in a relation method on the object passed as a
        // second arg
        if (!$value && $obj && $obj instanceof DataObject && $obj->hasMethod($this->name)) {
            $funcName = $this->name;
            $value = $obj->$funcName()->getIDList();
        } elseif (is_string($value)) {
            $value = explode(",", $value);
        }

        parent::setValue($value, $obj);

        // We need to sort the fields according to the $value, so that the list of
        // fields apparing in the right order.
        $sortedSource = array();
        $sourceKeys = array_keys($this->source);
        foreach ($this->value as $item) {
            if (in_array($item, $sourceKeys)) {
                $sortedSource[$item] = $this->source[$item];
            }
        }
        $this->source = array_merge($sortedSource, $this->source);
        if (count($this->extra)) {
            foreach ($this->extra as $field => $type) {
                if ($obj && isset($obj->$field)) {
                    $this->extraValue[$field] = $obj->$field;
                }
            }
        }
        return $this;
    }
    
    
    /**
     * Validate this field
     *
     * @param Validator $validator
     * @return bool
     */
    public function validate($validator) {
        $values = $this->value;
        if (!$values) {
            return true;
        }
        $sourceArray = $this->getSourceAsArray();
        $values = array_keys($values);
        $validValues = array_keys($sourceArray);
        if (is_array($values)) {
            if (!array_intersect($validValues, $values)) {
                $validator->validationError(
                    $this->name,
                    _t(
                        'CheckboxSetField.SOURCE_VALIDATION',
                        "Please select a value within the list provided. '{value}' is not a valid option",
                        array('value' => implode(' and ', $values))
                    ),
                    "validation"
                );
                return false;
            }
        } else {
            if (!in_array($this->value, $validValues)) {
                $validator->validationError(
                    $this->name,
                    _t(
                        'CheckboxSetField.SOURCE_VALIDATION',
                        "Please select a value within the list provided. '{value}' is not a valid option",
                        array('value' => $this->value)
                    ),
                    "validation"
                );
                return false;
            }
        }
        return true;
    }
}

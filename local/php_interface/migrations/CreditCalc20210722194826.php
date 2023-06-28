<?php

namespace Sprint\Migration;


class CreditCalc20210722194826 extends Version
{
    protected $description = "";

    protected $moduleVersion = "3.25.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'CreditCalc',
  'TABLE_NAME' => 'wf_credit_calc',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Кредиты - калькулятор',
    ),
    'en' => 
    array (
      'NAME' => 'Кредиты - калькулятор',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_CREDIT',
  'USER_TYPE_ID' => 'enumeration',
  'XML_ID' => '',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 5,
    'CAPTION_NO_VALUE' => '',
    'SHOW_NO_VALUE' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Кредит',
    'ru' => 'Кредит',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Кредит',
    'ru' => 'Кредит',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Кредит',
    'ru' => 'Кредит',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_CREDIT',
    'ru' => 'UF_CREDIT',
  ),
  'ENUM_VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Автокредит',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'autocredit',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_TYPE',
  'USER_TYPE_ID' => 'enumeration',
  'XML_ID' => '',
  'SORT' => '150',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 5,
    'CAPTION_NO_VALUE' => '',
    'SHOW_NO_VALUE' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Тип расчета',
    'ru' => 'Тип расчета',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Тип расчета',
    'ru' => 'Тип расчета',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Тип расчета',
    'ru' => 'Тип расчета',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_TYPE',
    'ru' => 'UF_TYPE',
  ),
  'ENUM_VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Аннуитентный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'annuet',
    ),
    1 => 
    array (
      'VALUE' => 'Дифференцированный',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'differenc',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_START_SUM',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '200',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 100,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Сумма от',
    'ru' => 'Сумма от',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сумма от',
    'ru' => 'Сумма от',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сумма от',
    'ru' => 'Сумма от',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_START_SUM',
    'ru' => 'UF_START_SUM',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_END_SUM',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '300',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 100,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Сумма до',
    'ru' => 'Сумма до',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сумма до',
    'ru' => 'Сумма до',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сумма до',
    'ru' => 'Сумма до',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_END_SUM',
    'ru' => 'UF_END_SUM',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_DAYS',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 100,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Дни',
    'ru' => 'Дни',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Дни',
    'ru' => 'Дни',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Дни',
    'ru' => 'Дни',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_DAYS',
    'ru' => 'UF_DAYS',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_PERCENT',
  'USER_TYPE_ID' => 'double',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'Y',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'PRECISION' => 2,
    'SIZE' => 20,
    'MIN_VALUE' => 0.0,
    'MAX_VALUE' => 0.0,
    'DEFAULT_VALUE' => 0.0,
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Процентная ставка',
    'ru' => 'Процентная ставка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Процентная ставка',
    'ru' => 'Процентная ставка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Процентная ставка',
    'ru' => 'Процентная ставка',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_PERCENT',
    'ru' => 'UF_PERCENT',
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}

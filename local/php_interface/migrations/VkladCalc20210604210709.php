<?php

namespace Sprint\Migration;


class VkladCalc20210604210709 extends Version
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
  'NAME' => 'VkladCalc',
  'TABLE_NAME' => 'vklad_calc',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Вклады - калькулятор',
    ),
    'en' => 
    array (
      'NAME' => 'Вклады - калькулятор',
    ),
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_VKLAD_ID',
  'USER_TYPE_ID' => 'iblock_element',
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
    'IBLOCK_ID' => 'chastnim:rekomenduemoe-vklads',
    'DEFAULT_VALUE' => '',
    'ACTIVE_FILTER' => 'N',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Вклад',
    'ru' => 'Вклад',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Вклад',
    'ru' => 'Вклад',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Вклад',
    'ru' => 'Вклад',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
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
    'SIZE' => 20,
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
    'en' => '',
    'ru' => '',
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
    'SIZE' => 20,
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
    'en' => '',
    'ru' => '',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_CURRENCY',
  'USER_TYPE_ID' => 'enumeration',
  'XML_ID' => '',
  'SORT' => '400',
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
    'en' => 'Валюта',
    'ru' => 'Валюта',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Валюта',
    'ru' => 'Валюта',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Валюта',
    'ru' => 'Валюта',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'ENUM_VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'RUB',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'RUB',
    ),
    1 => 
    array (
      'VALUE' => 'EUR',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'EUR',
    ),
    2 => 
    array (
      'VALUE' => 'USD',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'USD',
    ),
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
    'SIZE' => 20,
    'MIN_VALUE' => 0,
    'MAX_VALUE' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Кол-во дней',
    'ru' => 'Кол-во дней',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Кол-во дней',
    'ru' => 'Кол-во дней',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Кол-во дней',
    'ru' => 'Кол-во дней',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_PERCENT',
  'USER_TYPE_ID' => 'double',
  'XML_ID' => '',
  'SORT' => '600',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
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
    'DEFAULT_VALUE' => '',
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
    'en' => '',
    'ru' => '',
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}

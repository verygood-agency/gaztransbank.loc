<?php

namespace Sprint\Migration;


class GuaranteesCalc20210730132550 extends Version
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
  'NAME' => 'Guarantees',
  'TABLE_NAME' => 'wf_guarantees',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Банковские гарантии - калькулятор',
    ),
    'en' => 
    array (
      'NAME' => 'Банковские гарантии - калькулятор',
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
  'SHOW_FILTER' => 'I',
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
    'en' => 'Тип БГ',
    'ru' => 'Тип БГ',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Тип БГ',
    'ru' => 'Тип БГ',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Тип БГ',
    'ru' => 'Тип БГ',
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
      'VALUE' => 'На исполнение контракта',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'contracts',
    ),
    1 => 
    array (
      'VALUE' => 'На участие',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'participate',
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
    'en' => 'UF_PERCENT',
    'ru' => 'UF_PERCENT',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_MIN_PRICE',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '700',
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
    'en' => 'Минимальная стоимость',
    'ru' => 'Минимальная стоимость',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Минимальная стоимость',
    'ru' => 'Минимальная стоимость',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Минимальная стоимость',
    'ru' => 'Минимальная стоимость',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'UF_MIN_PRICE',
    'ru' => 'UF_MIN_PRICE',
  ),
));
    }

    public function down()
    {
        //your code ...
    }
}

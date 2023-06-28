<?php

namespace Sprint\Migration;


class VkladTarifsTables20210604210653 extends Version
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
  'NAME' => 'VkladTarifsTables',
  'TABLE_NAME' => 'vklad_tarifs_tables',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Вклады - таблицы тарифов',
    ),
    'en' => 
    array (
      'NAME' => 'Вклады - таблицы тарифов',
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
  'FIELD_NAME' => 'UF_SORT',
  'USER_TYPE_ID' => 'integer',
  'XML_ID' => '',
  'SORT' => '150',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
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
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Сортировка',
    'ru' => 'Сортировка',
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
  'FIELD_NAME' => 'UF_TARIF',
  'USER_TYPE_ID' => 'string',
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
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Тариф',
    'ru' => 'Тариф',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Тариф',
    'ru' => 'Тариф',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Тариф',
    'ru' => 'Тариф',
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
  'FIELD_NAME' => 'UF_STATRT_SUMM',
  'USER_TYPE_ID' => 'string',
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
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Первоначальная сумма вклада',
    'ru' => 'Первоначальная сумма вклада',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Первоначальная сумма вклада',
    'ru' => 'Первоначальная сумма вклада',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Первоначальная сумма вклада',
    'ru' => 'Первоначальная сумма вклада',
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
  'USER_TYPE_ID' => 'string',
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
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
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
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_CELL_1',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '500',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ячейка 1',
    'ru' => 'Ячейка 1',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ячейка 1',
    'ru' => 'Ячейка 1',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ячейка 1',
    'ru' => 'Ячейка 1',
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
  'FIELD_NAME' => 'UF_CELL_2',
  'USER_TYPE_ID' => 'string',
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
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ячейка 2',
    'ru' => 'Ячейка 2',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ячейка 2',
    'ru' => 'Ячейка 2',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ячейка 2',
    'ru' => 'Ячейка 2',
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
  'FIELD_NAME' => 'UF_CELL_3',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '700',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ячейка 3',
    'ru' => 'Ячейка 3',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ячейка 3',
    'ru' => 'Ячейка 3',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ячейка 3',
    'ru' => 'Ячейка 3',
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
  'FIELD_NAME' => 'UF_CELL_4',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '800',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ячейка 4',
    'ru' => 'Ячейка 4',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ячейка 4',
    'ru' => 'Ячейка 4',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ячейка 4',
    'ru' => 'Ячейка 4',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => 'Ячейка 4',
    'ru' => 'Ячейка 4',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_CELL_5',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => '',
  'SORT' => '900',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Ячейка 5',
    'ru' => 'Ячейка 5',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Ячейка 5',
    'ru' => 'Ячейка 5',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Ячейка 5',
    'ru' => 'Ячейка 5',
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

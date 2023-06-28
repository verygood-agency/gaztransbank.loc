<?php

namespace Sprint\Migration;


class tarifsanddocsCategory20210423135305 extends Version
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

        $iblockId = $helper->Iblock()->getIblockIdIfExists(
            'tarifs-and-docs',
            'chastnim'
        );

        $helper->Iblock()->addSectionsFromTree(
            $iblockId,
            array (
  0 => 
  array (
    'NAME' => 'Тарифы для физических лиц подразделы',
    'CODE' => 'tarify-dlya-fizicheskikh-lits-podrazdely',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
  ),
  1 => 
  array (
    'NAME' => 'Тарифы для юридических лиц, индивидуальных предпринимателей  и физических лиц, занимающихся в установленном',
    'CODE' => 'tarify-dlya-yuridicheskikh-lits-individualnykh-predprinimateley-i-fizicheskikh-lits-zanimayushchikhs',
    'SORT' => '500',
    'ACTIVE' => 'Y',
    'XML_ID' => NULL,
    'DESCRIPTION' => '',
    'DESCRIPTION_TYPE' => 'text',
  ),
)        );
    }

    public function down()
    {
        //your code ...
    }
}

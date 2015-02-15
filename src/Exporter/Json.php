<?php
namespace Gettext\Languages\Exporter;

class Json extends Exporter
{
    /**
     * Return the options for json_encode.
     * @return int
     */
    protected static function getEncodeOptions()
    {
        return 0;
    }
    /**
     * @see Exporter::toStringDo
     */
    protected static function toStringDo($languages)
    {
        $list = array();
        foreach ($languages as $language) {
            $item = array();
            $item['name'] = $language->name;
            if (isset($language->supersededBy)) {
                $item['supersededBy'] = $language->supersededBy;
            }
            if (isset($language->territory)) {
                $item['territory'] = $language->territory;
            }
            if (isset($language->baseLanguage)) {
                $item['baseLanguage'] = $language->baseLanguage;
            }
            $item['formula'] = $language->formula;
            $item['plurals'] = count($language->categories);
            $item['cases'] = array();
            $item['examples'] = array();
            foreach ($language->categories as $category) {
                $item['cases'][] = $category->id;
                $item['examples'][$category->id] = $category->examples;
            }
            $list[$language->id] = $item;
        }

        return json_encode($list, static::getEncodeOptions());
    }
}

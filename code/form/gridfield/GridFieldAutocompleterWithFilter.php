<?php
/**
 * @package  newsletter
 */

class GridFieldAutocompleterWithFilter extends GridFieldAddExistingAutocompleter
{
    /**
     * When set, the returned search result will be filered accoringly
     * $filters = array('Name'=>'bob'); // only bob in the list
     * $filters = array('Name'=>array('aziz', 'bob')); // aziz and bob in list
     * $filters = array('Name'=>'bob, 'Age'=>21); // bob with the age 21
     * $filters = array('Name'=>'bob, 'Age'=>array(21, 43))); // bob with the Age 21 or 43
     * $filters = array('Name'=>array('bob','phil'), 'Age'=>array(21, 43)));
     *			// bob with the Age 21 or 43 and bob with the Age 21 or 43
     */
    public $filters = array();

    /**
     * When set, the returned search result will exculde some records accoringly
     * $excludes = array('Name'=>'bob'); // exclude bob from list
     * $excludes = array('Name'=>array('aziz', 'bob')); // exclude aziz and bob from list
     * $excludes = array('Name'=>'bob, 'Age'=>21); // exclude bob that has Age 21
     * $excludes = array(Name'=>'bob, 'Age'=>array(21, 43))); // exclude bob with Age 21 or 43
     * $excludes = array('Name'=>array('bob','phil'), 'Age'=>array(21, 43)));
     *			// bob age 21 or 43, phil age 21 or 43 would be excluded
     */
    public $excludes = array();

    /**
     * Returns a json array of a search results that can be used by for example Jquery.ui.autosuggestion
     *
     * @param GridField $gridField
     * @param SS_HTTPRequest $request
     * @return sting in JSON fromat
     */
    public function doSearch($gridField, $request)
    {
        $dataClass = $gridField->getList()->dataClass();
        $allList = $this->searchList ? $this->searchList : DataList::create($dataClass);

        $searchFields = ($this->getSearchFields())
            ? $this->getSearchFields()
            : $this->scaffoldSearchFields($dataClass);
        if (!$searchFields) {
            throw new LogicException(
                sprintf('GridFieldAddExistingAutocompleter: No searchable fields could be found for class "%s"',
                $dataClass));
        }

        // TODO Replace with DataList->filterAny() once it correctly supports OR connectives
        $stmts = array();
        foreach ($searchFields as $searchField) {
            $stmts[] .= sprintf('"%s" LIKE \'%s%%\'', $searchField,
                Convert::raw2sql($request->getVar('gridfield_relationsearch')));
        }

        $results = $allList->where(implode(' OR ', $stmts))->subtract($gridField->getList());
        $results = $results->sort($searchFields[0], 'ASC');
        $results = $results->limit($this->getResultsLimit());
        if (!empty($this->filters)) {
            $results = $results->addFilter($this->filters);
        }
        if (!empty($this->excludes)) {
            switch (count($this->excludes)) {
                case 1:
                    $key = key($this->excludes);
                    $results->exclude($key, $this->excludes[$key]);
                    break;
                case 2:
                    $results->exclude($this->excludes);
                    break;
                default:
                    throw new InvalidArgumentException('Incorrect number of arguments passed to filter()');
            }
        }
        $json = array();
        foreach ($results as $result) {
            $json[$result->ID] = SSViewer::fromString($this->resultsFormat)->process($result);
        }
        return Convert::array2json($json);
    }
}

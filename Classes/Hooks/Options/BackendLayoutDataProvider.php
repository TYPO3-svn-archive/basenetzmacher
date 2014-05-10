<?php
namespace Netzmacher\BaseNetzmacher\Hooks\Options;

/***************************************************************
 *
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Dirk Wildt, http://wildt.at.die-netzmacher.de
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in
 *  all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *  THE SOFTWARE.
 *
 ***************************************************************/

use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayout;
use \TYPO3\CMS\Backend\View\BackendLayout\DataProviderContext;
use \TYPO3\CMS\Backend\View\BackendLayout\BackendLayoutCollection;
use \TYPO3\CMS\Backend\Utility\BackendUtility;

/**
 * @author Dirk Wildt, http://wildt.at.die-netzmacher.de
 */
class BackendLayoutDataProvider implements \TYPO3\CMS\Backend\View\BackendLayout\DataProviderInterface {

    /**
     * Default Backend Layouts for Bootstrap Theme
     *
     * @var array
     */
    protected $backendLayouts = array(
        'start' => array(
            'title' => 'LLL:EXT:basenetzmacher/Resources/Private/Language/Backend.xlf:backend_layout.start',
            'config' => '
                backend_layout {
                    colCount = 6
                    rowCount = 3
                    rows {
                        1 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.3
                                    colPos = 3
                                    colspan = 6
                                }
                            }
                        }
                        2 {
                            columns {
                                1 {
                                    name = LLL:EXT:cms/locallang_ttc.xlf:colPos.I.1
                                    colPos = 0
                                    colspan = 6
                                }
                            }
                        }
                        3 {
                            columns {
                                1 {
                                    name = LLL:EXT:basenetzmacher/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                    colPos = 10
                                    colspan = 2
                                }
                                2 {
                                    name = LLL:EXT:basenetzmacher/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                    colPos = 11
                                    colspan = 2
                                }
                                3 {
                                    name = LLL:EXT:basenetzmacher/Resources/Private/Language/Backend.xlf:backend_layout.column.footer3
                                    colPos = 12
                                    colspan = 2
                                }
                            }
                        }
                    }
                }
            ',
            'icon' => 'EXT:basenetzmacher/Resources/Public/Images/BackendLayouts/start.gif'
        ),
    );

    /**
     * @param DataProviderContext $dataProviderContext
     * @param BackendLayoutCollection $backendLayoutCollection
     * @return void
     */
    public function addBackendLayouts(DataProviderContext $dataProviderContext, BackendLayoutCollection $backendLayoutCollection) {
        foreach ($this->backendLayouts as $key => $data) {
            $data['uid'] = $key;
            $backendLayout = $this->createBackendLayout($data);
            $backendLayoutCollection->add($backendLayout);
        }
    }

    /**
     * Gets a backend layout by (regular) identifier.
     *
     * @param string $identifier
     * @param integer $pageId
     * @return NULL|BackendLayout
     */
    public function getBackendLayout($identifier, $pageId){
        $backendLayout = NULL;
        if(array_key_exists($identifier,$this->backendLayouts)) {
            return $this->createBackendLayout($this->backendLayouts[$identifier]);
        }
        return $backendLayout;
    }

    /**
     * Creates a new backend layout using the given record data.
     *
     * @param array $data
     * @return BackendLayout
     */
    protected function createBackendLayout(array $data) {
        $backendLayout = BackendLayout::create($data['uid'], $data['title'], $data['config']);
        $backendLayout->setIconPath($this->getIconPath($data['icon']));
        $backendLayout->setData($data);
        return $backendLayout;
    }

    /**
     * Gets and sanitizes the icon path.
     *
     * @param string $icon Name of the icon file
     * @return string
     */
    protected function getIconPath($icon) {
        $iconPath = '';
        if (!empty($icon)) {
            $iconPath = $icon;
        }
        return $iconPath;
    }

}
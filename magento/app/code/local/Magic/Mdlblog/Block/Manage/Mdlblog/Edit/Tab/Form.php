<?php

class Magic_Mdlblog_Block_Manage_Mdlblog_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
		  if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $data = Mage::getSingleton('adminhtml/session')->getBlogData();
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif (Mage::registry('blog_data'))
            $data = Mage::registry('blog_data')->getData();
		
        $fieldset = $form->addFieldset('blog_form', array('legend' => Mage::helper('mdlblog')->__('Post information')));
	
        $fieldset->addField(
            'title',
            'text',
            array(
                 'label'    => Mage::helper('mdlblog')->__('Post Title'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'title',
            )
        );

        $validationErrorMessage = addslashes(
            Mage::helper('mdlblog')->__(
                "Please use only letters (a-z or A-Z), numbers (0-9) or symbols '-' and '_' in this field"
            )
        );

        $fieldset->addField(
            'identifier',
            'text',
            array(
                 'label'              => Mage::helper('mdlblog')->__('Post Identifier'),
                 'class'              => 'required-entry magic-mdlblog-validate-identifier',
                 'required'           => true,
                 'name'               => 'identifier',
                 'after_element_html' => '<span class="hint">' . $noticeMessage . '</span>'
                     . "<script>
                        Validation.add(
                            'magic-mdlblog-validate-identifier',
                            '" . $validationErrorMessage . "',
                            function(v, elm) {
                                var regex = new RegExp(/^[a-zA-Z0-9_-]+$/);
                                return v.match(regex);
                            }
                        );
                        </script>",
            )
        );

        /**
         * Check is single store mode
         */
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField(
                'store_id',
                'multiselect',
                array(
                     'name'     => 'stores[]',
                     'label'    => Mage::helper('cms')->__('Store View'),
                     'title'    => Mage::helper('cms')->__('Store View'),
                     'required' => true,
                     'values'   => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
                )
            );
        }

        $categories = array();
        $collection = Mage::getModel('mdlblog/cat')->getCollection()->setOrder('sort_order', 'asc');
        foreach ($collection as $cat) {
            $categories[] = (array(
                'label' => (string)$cat->getTitle(),
                'value' => $cat->getCatId()
            ));
        }

        $fieldset->addField(
            'cat_id',
            'select',
            array(
                 'name'     => 'cats[]',
                 'label'    => Mage::helper('mdlblog')->__('Category'),
                 'title'    => Mage::helper('mdlblog')->__('Category'),
                 'required' => true,
                 
                 'values'   => $categories,
            )
        );

        $fieldset->addField(
            'status',
            'select',
            array(
                 'label'              => Mage::helper('mdlblog')->__('Status'),
                 'name'               => 'status',
                 'values'             => array(
                     array(
                         'value' => 1,
                         'label' => Mage::helper('mdlblog')->__('Enabled'),
                     ),
                     array(
                         'value' => 2,
                         'label' => Mage::helper('mdlblog')->__('Disabled'),
                     ),
                     array(
                         'value' => 3,
                         'label' => Mage::helper('mdlblog')->__('Hidden'),
                     ),
                 ),
            )
        );

        $fieldset->addField(
            'comments',
            'select',
            array(
                 'label'              => Mage::helper('mdlblog')->__('Comments Status'),
                 'name'               => 'comments',
                 'values'             => array(
                     array(
                         'value' => 0,
                         'label' => Mage::helper('mdlblog')->__('Enabled'),
                     ),
                     array(
                         'value' => 1,
                         'label' => Mage::helper('mdlblog')->__('Disabled'),
                     ),
                 ),
            )
        );
		
		 if (isset($data['blogimage']) && $data['blogimage']) {
            $data['blogimage'] = 'blog/images' . '/' . $data['blogimage'];
        }
		
		$fieldset->addField('blogimage', 'image', array(
          'label'     => 'Image',
		  'name'      => 'blogimage',
          'value'  => 'Uplaod'
        ));
		
	/*	$fieldset->addField('blogthumb', 'file', array(
          'label'     => 'Thumbnail',
		  'name'      => 'blogthumb',
          'value'  => 'Uplaod',
          'disabled' => false,
          'readonly' => true,
          'tabindex' => 1
        )); */

        try {
            $config = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            $config->setData(
                Mage::helper('mdlblog')->recursiveReplace(
                    '/blog_admin/',
                    '/' . (string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName') . '/',
                    $config->getData()
                )
            );
        } catch (Exception $ex) {
            $config = null;
        }

        if (Mage::getStoreConfig('mdlblog/mdlblog/useshortcontent')) {
            $fieldset->addField(
                'short_content',
                'editor',
                array(
                     'name'   => 'short_content',
                     'label'  => Mage::helper('mdlblog')->__('Short Content'),
                     'title'  => Mage::helper('mdlblog')->__('Short Content'),
                     'style'  => 'width:700px; height:100px;',
                     'config' => $config,
                )
            );
        }
        $fieldset->addField(
            'post_content',
            'editor',
            array(
                 'name'   => 'post_content',
                 'label'  => Mage::helper('mdlblog')->__('Content'),
                 'title'  => Mage::helper('mdlblog')->__('Content'),
                 'style'  => 'width:700px; height:500px;',
                 'config' => $config
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif (Mage::registry('blog_data')) {
            Mage::registry('blog_data')->setTags(
                Mage::helper('mdlblog')->convertSlashes(Mage::registry('blog_data')->getTags())
            );
            $form->setValues(Mage::registry('blog_data')->getData());
        }
		
		$fieldset->addField(
            'user',
            'text',
            array(
                 'label'              => Mage::helper('mdlblog')->__('Posted By'),
                 'name'               => 'user',
                 'style'              => 'width: 520px;',
            )
        );

        $outputFormat = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);

        $fieldset->addField(
            'created_time',
            'date',
            array(
                 'name'   => 'created_time',
                 'label'  => $this->__('Created on'),
                 'title'  => $this->__('Created on'),
                 'image'  => $this->getSkinUrl('images/grid-cal.gif'),
                 'format' => $outputFormat,
                 'time'   => true,
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif ($data = Mage::registry('blog_data')) {
            $form->setValues(Mage::registry('blog_data')->getData());
            if ($data->getData('created_time')) {
                $form->getElement('created_time')->setValue(
                    Mage::app()->getLocale()->date(
                        $data->getData('created_time'), Varien_Date::DATETIME_INTERNAL_FORMAT
                    )
                );
            }
        }
        return parent::_prepareForm();
    }
}
<?php

class Mdl_Featuredcategory_Block_Adminhtml_System_Configuration_HowtoUseExtension extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element){
     
       return '
<div class="entry-edit-head collapseable"><a onclick="Fieldset.toggleCollapse(\'featuredcategory_template\'); return false;" href="#" id="featuredcategory_template-head" class="open">How to use Extension Featuredcategory</a></div>
<input id="featuredcategory_template-state" type="hidden" value="1" name="config_state[featuredcategory_template]">
<fieldset id="featuredcategory_template" class="config collapseable" style="">
<h4 class="icon-head head-edit-form fieldset-legend">Code for featuredcategory</h4>
<br>
<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>
                <li>'.Mage::helper('featuredcategory')->__('You can put  featured category on Home page . Below is an example in which we put  featured category on home page ').'</li>				
            </ul>
        </li>
    </ul>
</div>
<br>
<ul>
	<li>
		<code>
             {{block type="featuredcategory/categoryblock"    name="featured" template="featuredcategory/featuredcat.phtml"}}
		</code>
	</li>
</ul>
<br>
<br>

<br>
<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>
                <li>'.Mage::helper('featuredcategory')->__('Another way to put featured category on Home page . Below is an example in which we put a featured category on home page ').'</li>				
            </ul>
        </li>
    </ul>
</div>
<br>
<ul>
	<li>
		<code>
               &lt;?xml version="1.0"?&gt;<br>
&lt;layout version="0.1.0"&gt;<br>
&nbsp;&nbsp;&lt;cms_index_index&gt;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&lt;reference name="content"&gt;<br>
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;block type="featuredcategory/categoryblock" name="featured" template="featuredcategory/featuredcat.phtml"&gt;<br>
			
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/block&gt;	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&lt;/reference><br>
&nbsp;&nbsp;&lt;/cms_index_index&gt;<br>
&lt;/layout&gt; 
		</code>
	</li>
</ul>
<br>
<br>
<div id="messages">
    <ul class="messages">
        <li class="notice-msg">
            <ul>			
                <li>'.Mage::helper('featuredcategory')->__('Below is an example to show featured Category on the left of the category page.').'</li>				
            </ul>
        </li>
    </ul>
</div>
<br>
<ul>
	<li>
		<code>
&lt;?xml version="1.0"?&gt;<br>
&lt;layout version="0.1.0"&gt;<br>
&nbsp;&nbsp;&lt;catalog_category_default&gt;<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&lt;reference name="left"&gt;<br>
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;block type="featuredcategory/categoryblock" name="featured" &gt;<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;action method="setTemplate"&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;template&gt;featuredcategory/featuredcat.phtml&lt;/template&gt;<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/action &gt;<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/block&gt;	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&lt;/reference><br>
&nbsp;&nbsp;&lt;/catalog_category_default&gt;<br>
&lt;/layout&gt;
</code>	
	</li>
</ul>
<br>

</fieldset>';

    }
}

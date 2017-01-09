<?php
class Mdl_Mdlnavi_Block_Mdlnavi extends Mage_Page_Block_Html_Topmenu
{

	public function getSidebarHtml($outermostClass = '', $childrenWrapClass = '')
	{
		Mage::dispatchEvent('page_block_html_topmenu_gethtml_before', array(
			'menu' => $this->_menu,
			'block' => $this
		));

		$this->_menu->setOutermostClass($outermostClass);
		$this->_menu->setChildrenWrapClass($childrenWrapClass);

		$html = parent::_getHtml($this->_menu, $childrenWrapClass);

		Mage::dispatchEvent('page_block_html_topmenu_gethtml_after', array(
			'menu' => $this->_menu,
			'html' => $html
		));

		return $html;
	}

	/**
	 * Recursively generates top menu html from data that is specified in $menuTree
	 *
	 * @param Varien_Data_Tree_Node $menuTree
	 * @param string $childrenWrapClass
	 * @return string
	 */
	protected function _getHtml(Varien_Data_Tree_Node $menuTree, $childrenWrapClass,$col=0)
	{
		$html = '';

		$children = $menuTree->getChildren();
		$parentLevel = $menuTree->getLevel();
		$childLevel = is_null($parentLevel) ? 0 : $parentLevel + 1;

		$counter = 1;
		$childrenCount = $children->count();

		$parentPositionClass = $menuTree->getPositionClass();
		$itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';
		$ncol = $col;
		foreach ($children as $child) {
			if($childLevel==0) {
				$cat = Mage::getModel('catalog/category')->load(str_replace('category-node-', '', $child->getId()));
				$rowPerCol = $cat->getMdlmdlnaviSelectcol();
			}
			$childClass = '';

			$child->setLevel($childLevel);
			$child->setIsFirst($counter == 1);
			$child->setIsLast($counter == $childrenCount);
			$child->setPositionClass($itemPositionClassPrefix . $counter);

			$outermostClassCode = '';
			$outermostClass = $menuTree->getOutermostClass();

			$megamenuData = array(
				'type' => '',
				'labelcolor' => '',
				'menu' => 1,
				'top' => '',
				'bottom' => '',
				'right' => '',
				'rsize' => 0,
			);						$category = Mage::getModel('catalog/category')->load(str_replace('category-node-', '', $child->getId()));
			$megamenuData['labelcolor'] = $category->getMdlmdlnaviLabelcolor();			$megamenuData['mdllabel'] = $category->getMdlmdlnaviMdllabel();
			if ($childLevel == 0 ) {
				if ($outermostClass) {
					$childClass .= ' '. $outermostClass;
				}
				
				$childClass .= ' '. $category->getMdlmdlnaviType();
				$megamenuData['type'] = $category->getMdlmdlnaviType();
				$megamenuData['labelcolor'] = $category->getMdlmdlnaviLabelcolor();
				$megamenuData['mdllabel'] = $category->getMdlmdlnaviMdllabel();
				$megamenuData['menu'] = $category->getMdlmdlnaviMenu();
				$megamenuData['top'] = $category->getMdlmdlnaviTop();
				$megamenuData['bottom'] = $category->getMdlmdlnaviBottom();
				$megamenuData['right'] = $category->getMdlmdlnaviRight();
				$megamenuData['rsize'] = $category->getMdlmdlnaviRightRsize();
				if ( $megamenuData['menu'] == '' ) $megamenuData['menu'] = 1;
				if ( $megamenuData['rsize'] == '' ) $megamenuData['rsize'] = 0;
			}

			$showChildren = false;
			$leftClass = $rightClass = $top = $bottom = $right = $menu = '';
			if (
				$child->hasChildren()
				|| ( $childLevel == 0 && $megamenuData['type'] == 'megamenu'
					&& ( !empty($megamenuData['top']) || !empty($megamenuData['bottom'])
						|| ( !empty($megamenuData['right']) && $megamenuData['rsize'] != 0 )
					)
				)
			) {
				$showChildren = true;
				$_cmsHelper = Mage::helper('cms');
 		        $_process = $_cmsHelper->getBlockTemplateProcessor(); 

				if ( $megamenuData['type'] == 'megamenu' ) {
					$top = $_process->filter($megamenuData['top']);
					$bottom = $_process->filter($megamenuData['bottom']);
					$right = $_process->filter($megamenuData['right']);
					$rsize = $megamenuData['rsize'];
				}
				if ( $megamenuData['menu'] == 1 || $megamenuData['type'] != 'megamenu' ) {
					if ($category->getMdlmdlnaviThumb()) {
						 $imagePath = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category'. DS . $category->getMdlmdlnaviThumb();
						 if (file_exists($imagePath)) {
							$rszImagePath = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category'. DS .'thumb' . DS . $category->getMdlmdlnaviThumb();
							if (!file_exists($rszImagePath)) {
								$image = new Varien_Image($imagePath);
								$image->save($rszImagePath);
							}
						}
						$menu .='<span class="cat_thumb"><a href="'.$category->getUrl().'"><img src="'.Mage::getBaseUrl('media') . 'catalog/category/thumb/'.$category->getMdlmdlnaviThumb().'" alt=""/></a></span>';
					}
					$menu .= '<ul class="level' . $childLevel . '">';
					$menu .= $this->_getHtml($child, $childrenWrapClass,$rowPerCol);
					$menu .= '</ul>';
				}

				if ( !$child->hasChildren() || $megamenuData['menu'] != 1 ) {
					$childClass .= ' parent parent-fake';
				}
			}

			$child->setClass($childClass);
			$html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
			$html .= '<a href="' . $child->getUrl() . '" '. $outermostClassCode . '>';
				
			$html.='<span>' ;
			$html.= $this->escapeHtml($child->getName()) . '</span>';
			if (!empty($megamenuData['mdllabel'])) {
					$html.='<span class="mdlabel lab-'.$megamenuData['labelcolor'].'">'.$megamenuData['mdllabel'].'</span>';
				}
			$html.='</a>' ;
			if ( $showChildren ) {
				if (!empty($childrenWrapClass)) {
					if($rowPerCol){ $rpc = ' col-block-'.$rowPerCol;} else { $rpc = ''; }
					$html .= '<div class="' . $childrenWrapClass . ' '.$rpc.'">';
				}

				if ( $childLevel == 0 && $megamenuData['type'] == 'megamenu' ) {
					$centerColumn = '';
					switch ( $rsize ) {
						case  1:
						if (empty($megamenuData['right'])) {
							$centerColumn = '<div class="col-sm-12">'.$menu.'</div>';
						}else{
							$centerColumn = '<div class="col-sm-9">'.$menu.'</div><div class="col-sm-3 menu-content">'.$right.'</div>';
						}
							break;
						case  2:
						if (empty($megamenuData['right'])) {
							$centerColumn = '<div class="col-sm-12">'.$menu.'</div>';
						}else{
							$centerColumn = '<div class="col-sm-6">'.$menu.'</div> <div class="col-sm-6 menu-content">'.$right.'</div>';
						}
							
							break;
						case '3' :
						if (empty($megamenuData['right'])) {
							$centerColumn = '<div class="col-sm-12">'.$menu.'</div>';
						}else{
							$centerColumn = '<div class="col-sm-3">'.$menu.'</div> <div class="col-sm-9 menu-content">'.$right.'</div>';
						}
							
							break;
						case '4' :
						if (empty($megamenuData['right'])) {
							$centerColumn = '<div class="col-sm-12">'.$menu.'</div>';
						}else{
							$centerColumn = '<div class="col-sm-12">'.$menu.'</div> <div class="col-sm-12 menu-content">'.$right.'</div>';
						}
							
							break;	
						default :
							if (empty($megamenuData['right'])) {
								$centerColumn = '<div class="col-sm-12">'.$menu.'</div>';
							}else{
								$centerColumn = '<div class="col-sm-9">'.$menu.'</div><div class="col-sm-3 menu-content">'.$right.'</div>';
							}
					}
					
					
					
					
							if (!empty($top)) {
								$html .= '<div class="topBlock  menu-content">'.$top.'</div>';
							}
							$html .= '<div class="row '.$rsize.'">';
							$html .= $centerColumn;
							$html .= '</div>';
							
							if (!empty($bottom)) {
								$html .= '<div class="bottomBlock menu-content">'.$bottom.'</div>';
							}
				} else {
					$html .= $menu;
				}
				if (!empty($childrenWrapClass)) {
					$html .= '</div>';
				}
				

			}
			
		
		$html .= '</li>';
				if($childLevel==1) {
					if($counter%$ncol==0){
					    if($childrenCount>$counter){
							$html .='</ul><ul class="level0">';
						}
					   }			
				}
			$counter++;
		}
		

		return $html;
	}

	/**
	 * @param string $type
	 * @param string $content
	 * @param string $class
	 * @return string
	 */
	protected function _drawMenuBlock($type, $content, $class = '')
	{
		$html = '';

		if ( !empty($content) ) {
			$html .= '<div class="static-content-'.$type.' '.$class.'">';
			$html .= $this->helper('mdlmdlnavi')->processCmsBlock($content);
			$html .= '</div>';
		}

		return $html;
	}
}
Author: kbabhishek4
Website: www.hokite.com
Module: Price Range Filter for OpenCart


Installation Notes:
1.Upload the "upload" directory files to the corresponding directories.
2.From the Administration panel enter Modules from the Extensions menu.
3.Install Price Range Filter module.
4.If you do not have permission you will have to set permission to modules/price_filter from the top administrator user group from within the admin configuration user menu.
5.Edit the module enter price range separated by -.
6.Edit product class for custom theme or leave it as product-layout for default theme

-----------------custom theme--------------------------------------------
1.For Custom Theme rename the default directory to your theme name , Directory Location(catalog/view/theme/default).
2.Upload the "upload" directory files.
3.Follow the points 2,3,4,5
4.Edit product class for custom theme and enter your product wrapper class 

Note: Finding your product wrapper class steps
	A.Goto \catalog\view\theme\{your_theme}\template\product\category.tpl
	B.Find <?php foreach ($products as $product) { ?>
	C.Then check next line copy unique class wrapper after class tag for default theme (<div class="product-layout product-list col-xs-12"> and unique class wrapper "product-layout") 


-------------------------CHANGES LOG------------------------------------

	version 2.2.0.0 (Latest version), 2.1.0.2 support added
	add to cart button is not working -- fixed
	tooltip design is changed -- fixed 
		
	version 2.3.0.1 - module kinda works, but weird
-----------------------------------------------------------------------
		
if u like it then follow us on 

	facebook - https://www.facebook.com/hokitedotcom
	linkedin - https://www.linkedin.com/company/hokite
	instagram - https://instagram.com/hokite/
	gplus - https://plus.google.com/114788820854352813708/
	
	cheers.. contact us at hokkite@gmail.com

---------------------------------------------------------------------
270717 - modifications by uzername to make it work with OC 2.3.0.1
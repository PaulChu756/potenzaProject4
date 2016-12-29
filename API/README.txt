Javascript and css files may be autoloaded using the following conventions

js
--global.js  <-- will be loaded on every page in the application
--module.js  <-- will be loaded on every page within the module
--{controller}  <-- actual controller name
----controller.js  <-- will be loaded on every page within the controller
----{action}.js    <-- will be loaded specifically on this action

css
--global.css  <-- will be loaded on every page in the application
--module.css  <-- will be loaded on every page within the module
--{controller}  <-- actual controller name
----controller.css  <-- will be loaded on every page within the controller
----{action}.css    <-- will be loaded specifically on this action

Images may be loaded using the assetUrl view helper.  E.g.

<img src="<?=$this->assetUrl('member',null,'test.jpg');?>" />

Paramaters are:
module - required
controller - optional
filename - required

#########$##################################################
# Use modgen.sh to quickly generate your module structure: #
# /bin/bash ./modgen.sh test tests                         #
#########$##################################################

Quick Start:

Let's assume you are wanting to deploy a module to manage "widgets."

1. Make a copy of the "example" folder and call it "widget"
2. Search and replace all instances of "Example" with "Widget"

grep "Example" . -lR --exclude="*\.svn*" | xargs sed -i 's/Example/Widget/g'

3. Search and replace all instances of "example" with "widget"

grep "example" . -lR --exclude="*\.svn*" | xargs sed -i 's/example/widget/g'

4. Do the same thing as #3 and #4 for file and directory names.

5. Add the following lines to application.ini:

; Widget Module
    resources.doctrine.orm.entityManagers.default.metadataDrivers.drivers.0.mappingNamespace      = "Widget\Entity"
    resources.doctrine.orm.entityManagers.default.metadataDrivers.drivers.0.mappingDirs[]         = APPLICATION_PATH "/modules/widget/Widget/Entity"
    autoloaderNamespaces[] = "Widget"
    
5. Copy the "widget" folder to application/modules/

6. Run doctrine ORM schema tool update (to generate MySQL tables) (see /scripts)

php scripts/doctrine.php orm:schema-tool:update --force

6. Clear the cache

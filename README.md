****# DigitalLabCMS
 DigitalLab CMS Clean

# File structure info

```text
|-- routes
|   |-- admin.php - this is admin routing file
|   |-- web.php - this is client routing file
```

## Write admin livewire components
#### In your .php file, in the `render()` method, at the end of the line `return view();` add `layout('components.layouts.admin.authorized');`

# Automate create translatable model and table
In your migration file insert this example, this util class, economy you time from create translatable model and migration class for multi language
```php
\App\Utils\WithTranslatable::create($modelClass, $foreignId, $mappedFillable, $modelPrimaryId);
```

### Example **$modelClass**
```php
$modelClass = \App\Models\Page::class;
```

### Example **$mappedFillable**
```php
$mappedFillable = [
    ['string' => 'title'],
    ['string' => 'name'],
    ['mediumText' => 'description'],
    ['mediumText' => 'keywords'],
    ['longText' => 'body'],
];
```

# Tree view component
In your livewire component include this snippet
```blade
<livewire:admin.components.tree.tree-inner :model-class="get_class($itemsCollection[0]->getModel())" :elements="$itemsCollection" />
```
### In you parent model add this trait and variables
```php
use App\Traits\WithTree;

protected $childModel = YouChildModel::class;

protected $childForeignId = 'foreign_id';

protected $routeNames = [
'edit'  => 'admin.pages.edit',
'create'  => 'admin.pages.create',
];

protected $showEditLink = true;

protected $showCreateLink = true;
```

### Property descriptions

<table>
    <tr>
        <td nowrap=""><strong>$childModel</strong></td>
        <td nowrap=""><strong>string</strong></td>
        <td nowrap="">This variable of child element model</td>
    </tr>
    <tr>
        <td nowrap=""><strong>$childForeignId: string</strong></td>
        <td nowrap=""><strong>string</strong></td>
        <td nowrap="">This variable of child model, where foreign id for parent table in DB</td>
    </tr>
    <tr>
        <td nowrap=""><strong>$routNames</strong></td>
        <td nowrap=""><strong>array</strong></td>
        <td nowrap="">In this variable write you edit and create link</td>
    </tr>
    <tr>
        <td nowrap=""><strong>$showEditLink</strong></td>
        <td nowrap=""><strong>bool</strong></td>
        <td nowrap="">This variable toggle show 'edit' link in your tree view item. Default: <b>true</b></td>
    </tr>
    <tr>
        <td nowrap=""><strong>$showCreateLink</strong></td>
        <td nowrap=""><strong>bool</strong></td>
        <td nowrap="">This variable toggle show 'create' link in your tree view item. Default: <b>true</b></td>
    </tr>
</table>

# Tinymce Instance
In you component use this example
```blade
<textarea name="content" data-is-upload="true" id="content" data-tiny data-tinymce-id="content" cols="30" rows="10"></textarea>
```


<table>
  <tr>
    <td nowrap><strong>data-tiny</strong></td>
    <td>this data attribute required from instance editor.</td>
  </tr>
  <tr>
    <td nowrap><strong>data-is-upload</strong></td>
    <td>true or false, from show file manager uploader</td>
  </tr>
  <tr>
    <td nowrap><strong>data-tinymce-id</strong></td>
    <td>attribute id.</td>
  </tr>
</table>


## Set listener for livewire
```html
<script>
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        adminFunctions.tinymceInstances()['content'].on('change', () => {
            @this.set('model', adminFunctions.tinymceInstances()['content'].getContent())
        })
    }, 200);
});
</script>
```


# Translatable model
Create two model, own model and `name`Translation

Create own model and add this example code

`$translationFkName` - Foreign key in table with translates

`$translationTableName` - Translatable model name

`$translationModelClass` - Translatable model class

is const `TABLE_NAME` - current table name 

# Example own model code 
```php
use Translatable;

protected string $translationFkName = 'page_id';
protected string $translationTableName = PageTranslation::TABLE_NAME;
protected string $translationModelClass = PageTranslation::class;

public const TABLE_NAME = "page";
protected $table = self::TABLE_NAME;
```

Create translatable model and add this code

is const `TABLE_NAME` - Current table name;
```php
public const TABLE_NAME = "page_translation";
protected $table = self::TABLE_NAME;
```

# Seo data trait
From use **SEO** add
```php
use SeoTrait;
```

### Seo data properties

`title` - this is **title** from `<title></title>`

`description` - this is **title** from `<meta name="description"`

`keywords` - this is **title** from `<meta name="keywords"`

`ogg_title` - this is **Social preview title** from `<meta property="og:title"` and another social title meta tags

`ogg_description` - this is **og:description** from `<meta property="og:description"` and another social descriptions meta tags

`image_url` - this is **og:image** from `<meta property="og:image"` and another social image(preview) meta tags

`ogg_image` - this is **og:image** from `<meta property="og:image"` and another social image(preview) meta tags


# Gallery uploader usage

In your .php class of livewire component add given code

Inside the body of the class
```php
public string|null $temp_id = null;
```

In `mount()` method paste this code
```php
if(!$this->isEditMode)
    $this->temp_id = uniqid();
```

In your .blade livewire component paste this code
```blade
@if($isEditMode)
<livewire:admin.components.gallery :model-type="\App\Models\Page::class" is-edit="1" :model-id="$item->id"/>
@else
<livewire:admin.components.gallery :model-type="\App\Models\Page::class"/>
@endif
```

# Variable descriptions
`model-type` - Insert your model class with namespace(**in editing record it required property**)

`model-id` - Is record id example `:model-id="$item->id"`

`model-type` - Insert your model class with namespace(**in editing record it required property**)

if editing mode the `is-edit` required property and pass in **1**

# Handle add support gallery
In your save method, after `model->save();` paste this code

`$this->item->id` replace for your public property
```php
if(!$this->isEditMode){
    $galleryItems = \App\Models\Gallery::findByModelTypeAndTempId(\App\Models\Page::class, $this->temp_id);
    foreach($galleryItems as $image) {
        $image->model_id = $this->item->id;
        $image->temp_id = null;
        $image->save();
    }
}
```

# Installing Spatie Permission
Run command

```shell
$ php artisan role:install
```
# Uninstalling Spatie Permission
Run command

```shell
$ php artisan role:uninstall
```

# Change Telegram bot token and chat id
```dotenv
TELEGRAM_BOT_ACCESS_TOKEN=#Put her telegram bot token
TELEGRAM_CHAT_ID=#Put her chat id
```

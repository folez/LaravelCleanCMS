# DigitalLabCMS
 DigitalLab CMS Clean

# File structure info

```text
|-- routes
|   |-- admin.php - this is admin routing file
|   |-- web.php - this is client routing file
```

## Write admin livewire components
#### In your .php file, in the `render()` method, at the end of the line `return view();` add `layout('components.layouts.admin.authorized');`


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

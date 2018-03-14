<?php
exit();
/**
 * Directory Structure
 *
 * https://documentation.concrete5.org/developers/environment/directory-structure
 *
 * application/
 * This is the folder where we add custom code or overrides those in the concrete directory.
 *
 * concrete/
 * This is the concrete source directory. This is the directory that contains most of the core files.
 *
 * packages/
 * This is the directory where you add custom-built packages or downloaded packages.
 *
 * updates/
 * This directory contains additional Concrete5 core files
 *
 *
 * Note: application/ directory is an empty carbon copy of concrete/ source directories.
 * If any concrete core functionality wish to be updated, you may do so by copying the file you wish to override
 * from the concrete/ directory into a directory exactly matching in the empty application structure.
 *
 */


/**
 * Single Pages
 *
 * https://documentation.concrete5.org/developers/working-with-pages/single-pages/overview
 *
 * Single page only
 * Create a php file in application/single_pages/ - named the php file to your desired page
 * Example : application/single_pages/media.php
 *
 * Multiple single pages in 1 section
 * Instead of php file - create a folder with your desired page
 * Example : application/single_pages/media
 *
 * Inside media folder - you create view.php - that will served as your index.php in
 * url path http://www.yoursite.com/index.php/media/
 *
 * To add more pages, just create a new php file with your desired name
 * Example : application/single_pages/media/add.php
 * application/single_pages/media/organize.php
 *
 * The other pages can be viewable as
 * http://www.yoursite.com/index.php/media/add.php
 * http://www.yoursite.com/index.php/media/organize.php
 *
 *
 * Add the single page via your project dashboard
 *
 */


/**
 * Single Page Controller
 *
 * Single Page only
 * To add controller to custom single page - create a single_page folder in application/controllers directory
 * then add your controller file inside - Example : media.php
 *
 *
 * Multiple single pages
 * Adding specific controller to multiple single pages are also possible.
 * If you have a page like -
 * http://www.yoursite.com/index.php/media/add.php
 * http://www.yoursite.com/index.php/media/organize.php
 *
 * you can add controller in the same filename and folder structure of single page into controller/single_pages
 * Example : application/controller/single_pages/media/add.php
 *
 * As for adding controller specific to view.php on Single page path application/single_pages/media/view.php
 * -I'm still not sure how to do it.
 *
 */

/**
 * Page Type
 *
 * Create new page type
 * To add new page type, Go to Pages & Themes -> Page Types
 *
 * To add a custom page for page type - create new page templates
 * 1. Create a new php file in path application/page_templates/ with a filename the same as your desired page type handle. Ex: media_entry.php
 * 2. Go to Pages & Themes -> Page Templates and click Add Template
 * 3. Add name and handle - handle should be same of your php filename and page type handle.
 *
 * If you already have a page type or just creating new one - make sure that the page type handle is same as your page template handle.
 * In Basic details form, Choose the created template as your Default Page template and Allowed Page templates option.
 *
 * If the template did not work, make sure your cache is disabled.
 * If by any chance the detailed page still not working, check the Page settings -> Design and see if the created template is really assigned.
 *
 */


/**
 * Page Type Controller
 *
 * https://documentation.concrete5.org/developers/working-with-pages/controllers-for-page-types
 *
 * To assign a controller to custom page types - Create page_types folder in application/controllers/
 * Inside the created folder application/controllers/page_types, add the controller file
 *
 *
 * As per the documentation,  you may or not extend PageTypeController class.
 * They say it is not strictly necessary but in the future there might add important methods within the class.
 *
 */


/**
 * Classes and Helpers
 *
 * Helpers can be called using Core::make('') directly on single pages/templates
 *
 * For Controllers - There are 2 ways to do that
 *
 * 1.
 * $app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
 * $app->make('') by putting the application facade in the $app variable
 *
 * 2.
 * Define use Core; at the top of class so that Core::make will work
 *
 */


/** @var \Concrete\Core\Page\Page $page */

/** @var \Concrete\Core\Page\PageList $pageLists */

$pageLists = new PageList();
$pageLists->filterByPageTypeHandle('handle');

/** @var \Concrete\Core\Attribute\Key\CollectionKey $collectionKey */

/** To get the attribute inside single page */
$collectionKey = \Concrete\Core\Attribute\Key\CollectionKey::getByHandle();
/** getByHandle and getByID function on CollectionKey is a static method therefore it cannot be accessed using the arrow operator -> */

/**
 * Pagination
 *
 * You can call concrete5 default pagination directly on pageLists
 * Syntax is located at @var \Concrete\Core\Search\ItemList\ItemList
 * but extended in $pageLists class
 */
$pageLists->setItemsPerPage(2);
$pageLists->getPagination();

/** @var \Concrete\Core\Entity\Attribute\Key\PageKey $pageKey to getController() */
$pageKey = CollectionKey::getByHandle('news_category');
$pageKey->getController();

/** To get the attribute select value */
/** @var \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $option */
/** @var  $category */
foreach ($pageKey->getController()->getOptions() as $option) {
    $category[$option->getSelectAttributeOptionValue()] = $option->getSelectAttributeOptionValue();
}

/** You may also automatically generate a select html code with option values by using render function */
/** @var \Concrete\Core\View\AbstractView $av is an extends of Attribute View class*/
/** @var  \Concrete\Core\Attribute\View $view */
$av = New View('instance'); /** expects instance param */
$av->render('form'); /** render function is located on the AbstractView class - it accepts only a context defined value (form, composer, search, type_form, label)  */

/** @var \Concrete\Core\Localization\Service\Date $dh */
$dh = Core::make('date');
/** or */
$dh = Core::make('helper/date');

/** @var \Concrete\Core\Html\Service\Navigation $nh */
$nh = Core::make('helper/navigation');

/** @var \Concrete\Core\User\User $user */
$user = \Concrete\Core\User\User::getByUserID($page->getCollectionUserID());
$userInfo = $user->getUserInfoObject();
/** @var \Concrete\Core\User\UserInfo $userInfo */
$userInfo->getUserDisplayName();

/** @var Concrete\Core\Form\Service\Form $form */
$form = Core::make('helper/form');

/** @var Concrete\Core\Form\Service\Widget\Attribute $formAttr */
$formAttr = Core::make('helper/form/attribute');

/** @var \Concrete\Core\Form\Service\Widget\Color $color */
$color = Core::make('helper/form/color');

/** @var \Concrete\Core\Form\Service\Widget\Typography $font */
$font = Core::make('helper/form/font');

/** @var \Concrete\Core\Form\Service\Widget\Typography $typography */
$typography = Core::make('helper/form/typography');

/** @var \Concrete\Core\Form\Service\Widget\DateTime $datetime */
$datetime = Core::make('helper/form/date_time');

/** @var \Concrete\Core\Form\Service\Widget\PageSelector $pageSelector */
$pageSelector = Core::make('helper/form/page_selector');

/** @var \Concrete\Core\Form\Service\Widget\Rating $rating */
$rating = Core::make('helper/form/rating');

/** @var \Concrete\Core\Form\Service\Widget\UserSelector $userSelector */
$userSelector = Core::make('helper/form/user_selector');

/** @var \Concrete\Core\Form\Service\Widget\ExpressEntrySelector $expressSelector */
$expressSelector = Core::make('helper/form/express_selector');

/** @var \Concrete\Core\Html\Service\Html $html */
$html = Core::make('helper/html');

/** @var Concrete\Core\Html\Service\Lightbox $lightbox */
$lightbox = Core::make('helper/lightbox');

/** @var Concrete\Core\Html\Service\Seo $seo */
$seo = Core::make('helper/seo');

/** @var \Concrete\Core\File\Image\BasicThumbnailer $ih */
$ih = Core::make('helper/image');

/** @var Concrete\Core\File\Service\File $file */
$file = Core::make('helper/file');

/** @var Concrete\Core\File\Service\Application $cFile */
$cFile = Core::make('helper/concrete/file');

/** @var \Concrete\Core\File\Service\Mime $mime */
$mime = Core::make('helper/mime');

/** @var \Concrete\Core\File\Service\Zip $zip */
$zip = Core::make('helper/zip');

/** @var \Concrete\Core\Http\Service\Ajax $ajax */
$ajax = Core::make('helper/ajax');

/** @var \Concrete\Core\Http\Service\Json $json */
$ajax = Core::make('helper/json');

/** @var \Concrete\Core\Mail\Service $sendMail */
$sendMail = Core::make('helper/mail');

/** @var \Concrete\Core\Utility\Service\Text $th */
$th = Core::make('helper/text');

/** @var \Concrete\Core\Utility\Service\Arrays $ah */
$ah = Core::make('helper/arrays');

/** @var \Concrete\Core\Utility\Service\Number $nh */
$nh = Core::make('helper/number');

/** @var \Concrete\Core\Utility\Service\Xml $xh */
$xh = Core::make('helper/xml');

/** @var \Concrete\Core\Utility\Service\Url $uh */
$uh = Core::make('helper/url');

/** @var Concrete\Core\Antispam\Service $antispam */
$antispam = Core::make('helper/validation/antispam');

/** @var Concrete\Core\Captcha\Service $captcha */
$captcha = Core::make('helper/validation/captcha');
/** or */
$captcha = Core::make('captcha');

/** @var \Concrete\Core\File\ValidationService $fh */
$fh = Core::make('helper/validation/file');

/** @var \Concrete\Core\Form\Service\Validation $validation */
$validation = Core::make('helper/validation/form');

/** @var \Concrete\Core\Utility\Service\Identifier $identifier */
$identifier = Core::make('helper/validation/identifier');

/** @var \Concrete\Core\Permission\IPService $ip */
$ip = Core::make('helper/validation/ip');
/** or */
$ip = Core::make('ip');

/** @var \Concrete\Core\Utility\Service\Validation\Numbers $numbers */
$numbers = Core::make('helper/validation/numbers');

/** @var \Concrete\Core\Utility\Service\Validation\Strings $strings */
$strings = Core::make('helper/validation/strings');

/** @var \Concrete\Core\Validation\BannedWord\Service $bannedWords */
$bannedWords = Core::make('helper/validation/banned_words');

/** @var \Concrete\Core\Validation\SanitizeService $security */
$security = Core::make('helper/security');

/** @var Concrete\Core\Validation\CSRF\Token $token */
$token = Core::make('helper/validation/token');
/** or */
$token = Core::make('token');

/** @var \Concrete\Core\Error\ErrorList\ErrorList $errors */
$errors = Core::make('helper/validation/token');

/** @var \Concrete\Core\Feed\FeedService $feed*/
$feed = Core::make('helper/feed');

/** @var Concrete\Core\Localization\Service\CountryList $countryList */
$countryList = Core::make('helper/localization/countries');
/** or */
$countryList = Core::make('helper/lists/countries');
/** or */
$countryList = Core::make('localization/countries');
/** or */
$countryList = Core::make('lists/countries');

/** @var \Concrete\Core\Localization\Service\StatesProvincesList $statesProvincesList */
$statesProvincesList = Core::make('helper/localization/states/provinces');
/** or */
$statesProvincesList = Core::make('helper/lists/states_provinces');
/** or */
$statesProvincesList = Core::make('localization/states_provinces');
/** or */
$statesProvincesList = Core::make('lists/states_provinces');

/** @var \Concrete\Core\Localization\Service\LanguageList $languages */
$languages = Core::make('localization/languages');

/** @var \Concrete\Core\Multilingual\Service\UserInterface\Flag $flag */
$flag =  Core::make('multilingual/interface/flag');

/** @var \Concrete\Core\Multilingual\Service\Detector $detector */
$detector = Core::make('multilingual/detector');

/** @var \Concrete\Core\Multilingual\Service\Extractor $extractor */
$extractor = Core::make('multilingual/extractor');

/** @var \Concrete\Core\Encryption\EncryptionService $encryption */
$encryption = Core::make('helper/encryption');

/** @var \Concrete\Core\Application\Service\FileManager $asset */
$asset = Core::make('helper/concrete/asset_library');
/** or */
$asset = Core::make('helper/concrete/file_manager');

/** @var \Concrete\Core\Application\Service\Composer $composer */
$composer = Core::make('helper/concrete/composer');

/** @var \Concrete\Core\Application\Service\Dashboard $dashboard */
$dashboard = Core::make('helper/concrete/dashboard');

/** @var \Concrete\Core\Application\Service\Dashboard\Sitemap $sitemap */
$sitemap = Core::make('helper/concrete/dashboard/sitemap');

/** @var \Concrete\Core\Application\Service\UserInterface $ui */
$ui = Core::make('helper/concrete/ui');

/** @var \Concrete\Core\Application\Service\UserInterface\Menu $uiMenu */
$uiMenu = Core::make('helper/concrete/ui/menu');

/** @var \Concrete\Core\Application\Service\UserInterface\Help $uiHelp */
$uiHelp = Core::make('helper/concrete/ui/help');
/** or */
$uiHelp = Core::make('help');

/** @var \Concrete\Core\Application\Service\Urls $urls */
$urls = Core::make('helper/concrete/urls');

/** @var Concrete\Core\Application\Service\User $userService */
$userService = Core::make('helper/concrete/user');

/** @var Concrete\Core\Application\Service\Validation $serviceValidation */
$serviceValidation = Core::make('helper/concrete/validation');

/** @var Concrete\Attribute\Rating\Service $serviceRating */
$serviceRating = Core::make('helper/rating');

/** @var \Concrete\Core\Legacy\Pagination $pagination */
$pagination = Core::make('helper/pagination');

/** @var \Concrete\Core\Application\Service\UserInterface\Help\CoreManager $helpCore */
$helpCore = Core::make('help/core');

/** @var \Concrete\Core\Application\Service\UserInterface\Help\DashboardManager $dashboardHelp */
$dashboardHelp = Core::make('help/dashboard');

/** @var \Concrete\Core\Application\Service\UserInterface\Help\BlockTypeManager $blockHelp */
$blockHelp = Core::make('help/block_type');

/** @var \Concrete\Core\Application\Service\UserInterface\Help\PanelManager $panelHelp */
$panelHelp = Core::make('help/panel');

/** @var  $config */
/**
 * https://documentation.concrete5.org/developers/packages/storing-configuration-values
 * https://documentation.concrete5.org/developers/appendix/concrete5-version-8-coding-styles/configuration
 */

/** --By assigning the class in variable */
$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
$config = $app->make('config');
/** or */
$config = $app->make('config/database');
/** -- */

/** -- By defining Core at the top of class (Use Core;)  */
$config = Core::make('config');
/** or */
$config = Core::make('config/database');
/** -- */

/** For now, let's just use Core::make */

/**
 * To get the connection to the current database
 * https://documentation.concrete5.org/developers/appendix/concrete5-version-8-coding-styles/database
 */

/** @var Doctrine\DBAL\Connection $db */
$db = Core::make('database')->connection();

/** Replacement of $db->Execute() and $db->Query() */
$db->executeQuery();
/**
 * $db->Execute() accepts second parameter either an array or a single value but on $db->executeQuery() the second parameter must be an array
 *
 * return value differences:
 * In case of failures, $db->executeQuery() will throw an instance of the Concrete\Core\Database\Driver\PDOStatement class even for update & delete queries
 */

/** Replacement of $db->GetRow() */
$db->fetchAssoc();
/**
 * $db->GetRow() accepts second parameter either an array or a single value but on $db->fetchAssoc() the second parameter must be an array
 *
 * return value differences:
 * $db->GetRow() returns an empty array if the requested row wasn't found.
 * $db->fetchAssoc() returns false if the row can't be found.
 */

/** Replacement of $db->qstr() */
$db->quote();
/**
 *  No differences
 */

/** Replacement of $db->GetOne() */
$db->fetchColumn();
/**
 * $db->GetOne() accepts second parameter either an array or a single value but on $db->fetchColumn() the second parameter must be an array
 */

/** Replacement of $db->GetArray() */
$db->fetchAll();
/**
 * $db->GetArray() accepts second parameter either an array or a single value but on $db->fetchAll() the second parameter must be an array
 */

/** Replacement of $db->GetAssoc() */
$db->executeQuery()->fetchAll(\PDO::FETCH_KEY_PAIR); /** In case of two columns in the result */
/**
 * $db->GetAssoc() accepts second parameter either an array or a single value but on $db->executeQuery() the second parameter must be an array
 */
$db->fetchAll(…); /** In case of more than two columns in the result */

$result = [];
foreach ($db->fetchAll(…) as $row) {
    $key = array_shift($row);
    $result[$key] = $row;
}
/**
 * $db->GetAssoc() accepts second parameter either an array or a single value but on $db->fetchAll() the second parameter must be an array
 */

/** Replacement of $db->Replace() */
/** no replacement so far */

/** Replacement of $db->GetCol() */
$result = [];
foreach ($db->fetchAll(…) as $row) {
    $result[] = $row[key($row)];
}
/**
 * $db->GetAssoc() accepts second parameter either an array or a single value but on $db->fetchAll() the second parameter must be an array
 */

/** Replacement of $db->Insert_ID() */
$db->lastInsertId();

/** Replacement of $db->BeginTrans() */
$db->beginTransaction();
/**
 * return value differences:
 * $db->BeginTrans() returns false in case of errors.
 * $db->beginTransaction() throws a PDOException in case of errors, no value is returned.
 */

/** Replacement of $db->CommitTrans() */
$db->commit();
/**
 * return value differences:
 * $db->CommitTrans() returns false in case of errors.
 * $db->commit() throws a Doctrine\DBAL\ConnectionException or a PDOException in case of errors, no value is returned.
 */

/** Replacement of $db->RollbackTrans() */
$db->rollBack();
/**
 * return value differences:
 * $db->RollbackTrans() returns false in case of errors.
 * $db->rollBack() throws a Doctrine\DBAL\ConnectionException or a PDOException in case of errors, no value is returned.
 */

/** Replacement of
 * $db->StartTrans()
 * $db->CompleteTrans()
 * $db->FailTrans()
 *
 * nested transactions is no longer supported
 * so for that use only the
 * $db->beginTransaction()
 * $db->commit()
 * $db->rollBack()
 */

/**
 * Including elements
 * https://documentation.concrete5.org/developers/appendix/concrete5-version-8-coding-styles/elements
 */

/** @var \Concrete\Core\View\View */
// Include a core element without arguments
View::element($element);

// Include a core element with arguments
View::element($element, ['argument1' => 'value1', 'argument2' => 'value2']);

// Include a package element without arguments
View::element($element, null, $packageHandle);

// Include a package element with arguments
View::element($element, ['argument1' => 'value1', 'argument2' => 'value2'], $packageHandle);

/**
 * HTTP methods request handler
 */

/** to identify which method used */
$this->request->getMethod();

/** GET method */
$this->get(); /** all input */
$this->get('name'); /** specific input */

/** POST method */
$this->post(); /** all input */
$this->post('name'); /** specific input */

/** REQUEST method */
$this->request(); /** all input */
$this->request('name'); /** specific input */

/**
 * Permissions
 */

/** Replacement for FilePermissions::getGlobal() */
$fp = new Permissions(FileSet::getGlobal());

/** Replacement for TaskPermission() */
$tp = new Permissions();

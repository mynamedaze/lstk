<?
require 'vendor/autoload.php';
ini_set('log_errors', 'On');
ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '/php-errors.log');


use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\NotesCollection;
use AmoCRM\Collections\TagsCollection;
use AmoCRM\Collections\TasksCollection;
use AmoCRM\Filters\LeadsFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CustomFieldsValues\SelectCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\SelectCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\SelectCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\NoteType\CommonNote;
use AmoCRM\Models\TagModel;
use AmoCRM\Models\TaskModel;
use League\OAuth2\Client\Token\AccessToken;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\LinksCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Filters\ContactsFilter;
use AmoCRM\Models\ContactModel;


$settings = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/token_info.json'), true);
//var_dump($settings);
$debugMode = true;

$clientId = $settings['CLIENT_ID'];
$clientSecret = $settings['CLIENT_SECRET'];
$redirectUri = $settings['CLIENT_REDIRECT_URI'];
$RESP_USER = 6354505;

$apiClient = new AmoCRMApiClient($clientId, $clientSecret, $redirectUri);

$apiClient->setAccountBaseDomain('timany08.amocrm.ru');
//$accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode('def50200d9fe2f5f8ee3b713c8177a56ca668cdad529ed16b41d4d344a8de28fe7d22bc0fe534fb6f0c671ade6d79b3edd97c5bb990ccef9084673f3b1cd242e2de02c4fbc9158bd6560bbcefd9ce145384bdd7c9b3f12e5e506ef4ad925fa2d52b6921afb67739fdbe38a1752ef8ff04e3796927089c329558f48f715a11de2a59713d7eb0f806feec2bdceaf86ea39d3e26c6452ea36ead105e5853ceb9d93cd0d3ef2084fe28ea26c9d5529cdc5626bbb4931494768f5102a511e00b2e27ecfa24a7157b8760964cf0b64f925351a010c9b3f9697573d328f87c2600e3fc609df33e499870782974ddd721ba3158a40ebeff1f85ac6427270550db9f0a0dcd5aff4beea8cdae90bcd90b056e5d726c1497939cb2c11d2ec1362bbd2db47a20bd292db9b5ee4e9589ebcc9950897723e5061fdef38c22a04bace50b72d3b7375fbbad3dc103e6c2813c7f9f8f68486df078e764cb8d95bab7c82f00525a625ea88840604484726197adde8740826588c6acfe50fe841054550dfecfb77f9b8c55e3634436a319188bb26b4a0c3da96f2bda8258ac368b7f7d0e09b33ede5258c42866e0ce8c0e8ff902e4ed51383bcb6e85add8b2b3bae253b8de44d5234f5cec45e8001de80f3ddecb4fb41ab9d56');
//var_dump($accessToken); exit;
$accessToken = getToken();


//var_dump($accessToken); exit;
$apiClient->setAccessToken($accessToken)
    ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
    ->onAccessTokenRefresh(
        function (\League\OAuth2\Client\Token\AccessTokenInterface $accessToken, string $baseDomain) {
            saveToken(
                [
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'baseDomain' => $baseDomain,
                ]
            );
        }); 

$phone = normalizePhoneAmo($phone);
$filter = new ContactsFilter();
$filter->setQuery($phone);
$filter->setLimit(1);

$contact_isset = new ContactsCollection();
try {
    $contact_isset = $apiClient->contacts()->get($filter, [\AmoCRM\Helpers\EntityTypesInterface::LEADS]);
	
} catch (AmoCRMApiException $e) {
	
}



 try {
$lead = new LeadModel(); 
$lead->setName('Заявка с ЛСТК');
$lead->setStatusId(36257173);
$lead->setResponsibleUserId($RESP_USER);


 $_COOKIE["utm_source"] =  (isset($_COOKIE["utm_source"]) && !empty($_COOKIE["utm_source"])) ? iconv(mb_detect_encoding($_COOKIE["utm_source"]), "UTF-8", $_COOKIE["utm_source"]) : '';
$_COOKIE["utm_campaign"] =  (isset($_COOKIE["utm_campaign"]) && !empty($_COOKIE["utm_campaign"])) ? iconv(mb_detect_encoding($_COOKIE["utm_campaign"]), "UTF-8", $_COOKIE["utm_campaign"]) : '';
$_COOKIE["utm_medium"] =  (isset($_COOKIE["utm_medium"]) && !empty($_COOKIE["utm_medium"])) ? iconv(mb_detect_encoding($_COOKIE["utm_medium"]), "UTF-8", $_COOKIE["utm_medium"]) : '';
$_COOKIE["utm_term"] =  (isset($_COOKIE["utm_term"]) && !empty($_COOKIE["utm_term"])) ? urldecode($_COOKIE["utm_term"]) : '';
$_COOKIE["utm_content"] =  (isset($_COOKIE["utm_content"]) && !empty($_COOKIE["utm_content"])) ? $_COOKIE["utm_content"] : '';
$_COOKIE["utm_term"] = mb_convert_encoding($_COOKIE["utm_term"], "utf-8");
$_COOKIE["utm_content"] = mb_convert_encoding($_COOKIE["utm_content"], "utf-8");
 
//добавляем поля к сделке utm, страницу, город если нужно
 $leadCustomFieldsValues = new CustomFieldsValuesCollection();

$leadCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(301711)->setValues((new TextCustomFieldValueCollection())
    ->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_source"]))));
$leadCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(301713)->setValues((new TextCustomFieldValueCollection())
    ->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_campaign"]))));
$leadCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(301715)->setValues((new TextCustomFieldValueCollection())
    ->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_medium"]))));
$leadCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(301717)->setValues((new TextCustomFieldValueCollection())
    ->add((new TextCustomFieldValueModel())->setValue((string)$_COOKIE["utm_term"]))));
$leadCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(301719)->setValues((new TextCustomFieldValueCollection())
    ->add((new TextCustomFieldValueModel())->setValue((string)$_COOKIE["utm_content"]))));






$lead->setCustomFieldsValues($leadCustomFieldsValues);

$status_id_proverka = [142, 143];
$status_lead = [
    'status' => false,
];

if ($contact_isset->count() > 0) {
    $id_leds = [];

    if (!is_null($contact_isset->first()->getLeads())) {

        $contact_isset_first = $contact_isset->first();
        foreach ($contact_isset_first->getLeads()->all() as $lead_filter) {
            $id_leds[] = $lead_filter->getId();
        }

        $filter = new LeadsFilter();
        $filter->setIds($id_leds);

        $leads_list = $apiClient->leads()->get($filter);
        foreach ($leads_list->all() as $leads_filter) {
            if (!in_array($leads_filter->getStatusId(), $status_id_proverka)) {
                $status_lead['status'] = true;
                $status_lead['lead_id'] = (int)$leads_filter->getId();
                $status_lead['responsible_user_id'] = (int)$leads_filter->getResponsibleUserId();
            }

        }
	}

        if ($status_lead['status']){
			
				//добавляем тег к сделке
            $tagsCollection = new TagsCollection();
            $tag = new TagModel();
            $tag->setName('Дубль сделки');
            $tagsCollection->add($tag);
            $lead->setTags($tagsCollection);

     
            $lead = $apiClient->leads()->addOne($lead);
          
			//делаем связь сделки и контакта
            $links = new LinksCollection();
            $links->add($contact_isset_first);
            
            $apiClient->leads()->link($lead, $links);
		
			
			
			
			/* //создаем задачу менеджеру если существует открытая сделка
            $tasksCollection = new TasksCollection();
            $task = new TaskModel();
            $task->setResponsibleUserId($status_lead['responsible_user_id'])
                ->setEntityId($status_lead['lead_id'])
                ->setEntityType(EntityTypesInterface::LEADS)
                ->setText('Заявка с сайта позвонить otdelka-derevyannykh-domov.ru')
                ->setCompleteTill(time() + 900);
            $tasksCollection->add($task);

            try {
                $tasksCollection = $apiClient->tasks()->add($tasksCollection);
            } catch (AmoCRMApiException $e) {
                if ($debugMode) {
                    var_export($e->getMessage());
                    die;
                }
            } */

        }else{
				//добавляем тег к сделке
            $tagsCollection = new TagsCollection();
            $tag = new TagModel();
            $tag->setName('Дубль закрытой сделки');
            $tagsCollection->add($tag);
            $lead->setTags($tagsCollection);

		
            $lead = $apiClient->leads()->addOne($lead);
			
			//делаем связь сделки и контакта
            $links = new LinksCollection();
            $links->add($contact_isset->first());

            $apiClient->leads()->link($lead, $links);


			}

		

	} else {


    $lead = $apiClient->leads()->addOne($lead);


	//создаем контакт
    $contact = new ContactModel();
    $contact->setName($name);
    $contactCustomFieldsValues = new CustomFieldsValuesCollection();
	//добавляем телефон контакта
    $contactCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(9145)->setValues((new TextCustomFieldValueCollection())
        ->add((new TextCustomFieldValueModel())->setValue($phone))));
	if(isset($email)){
	$contactCustomFieldsValues->add((new TextCustomFieldValuesModel())->setFieldId(9147)->setValues((new TextCustomFieldValueCollection())
        ->add((new TextCustomFieldValueModel())->setValue($email))));
	}
    $contact->setCustomFieldsValues($contactCustomFieldsValues);


    $contact = $apiClient->contacts()->addOne($contact);
   
	//делаем связь сделки и контакта
    $links = new LinksCollection();
    $links->add($contact);
 
    $apiClient->leads()->link($lead, $links);
   

}


	if(isset($message) and !empty($message)){
	//добавляем примечание к сделке
    $notesCollection = new NotesCollection();
    $serviceMessageNote = new CommonNote();
	$message = mb_convert_encoding($message, "utf-8");
    $serviceMessageNote->setEntityId($lead->getId())
        ->setText(strip_tags($message, '<br>'));
    $notesCollection->add($serviceMessageNote);
    $leadNotesService = $apiClient->notes(EntityTypesInterface::LEADS);
    
        $notesCollection = $leadNotesService->add($notesCollection);

}
 /*     //создаем задачу менеджеру
    $tasksCollection = new TasksCollection();
    $task = new TaskModel();
    $task->setResponsibleUserId($RESP_USER)
        ->setEntityId($lead->getId())
        ->setEntityType(EntityTypesInterface::LEADS)
        ->setText('Заявка с сайта позвонить otdelka-derevyannykh-domov.ru')
        ->setCompleteTill(time() + 900);
    $tasksCollection->add($task);

    try {
        $tasksCollection = $apiClient->tasks()->add($tasksCollection);
    } catch (AmoCRMApiException $e) {
        if ($debugMode) {
            var_export($e->getMessage());
            die;
        }
    } */


 } catch (AmoCRMApiException $e) {
	 
                if ($debugMode) {
                   var_dump($e);
                    die;
                }

  }

function saveToken($accessToken)
{

    $settings = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/token_info.json'), true);
    if (
        isset($accessToken)
        && isset($accessToken['accessToken'])
        && isset($accessToken['refreshToken'])
        && isset($accessToken['expires'])
        && isset($accessToken['baseDomain'])
    ) {
        $settings['accessToken'] = $accessToken['accessToken'];
        $settings['expires'] = $accessToken['expires'];
        $settings['refreshToken'] = $accessToken['refreshToken'];
        $settings['baseDomain'] = $accessToken['baseDomain'];

		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/token_info.json', json_encode($settings));
    

    } else {
        exit('Invalid access token ' . var_export($accessToken, true));
    }
}

function getToken()
{


    $accessToken = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/token_info.json'), true);

    if (
        isset($accessToken)
        && isset($accessToken['accessToken'])
        && isset($accessToken['refreshToken'])
        && isset($accessToken['expires'])
        && isset($accessToken['baseDomain'])
    ) {
        return new AccessToken([
            'access_token' => $accessToken['accessToken'],
            'refresh_token' => $accessToken['refreshToken'],
            'expires' => $accessToken['expires'],
            'baseDomain' => $accessToken['baseDomain'],
        ]);
    } else {
        exit('Invalid access token ' . var_export($accessToken, true));
    }
}

function normalizePhoneAmo($phone)
{
    $int = 0;
    $phone = trim($phone);

    if (strpos($phone, '+') === 0) {
        $int = 1;
    }

    $phone = preg_replace('/[^\d]/', '', $phone);
    $len = strlen($phone);
    if (!$int) {
        if ($len == 11)
            $phone = preg_replace('/^8/', '7', $phone);
        elseif ($len == 10)
            $phone = '+7' . $phone;
    }

    if ($int)
        $phone = '+' . $phone;

    return $phone;
}

?>
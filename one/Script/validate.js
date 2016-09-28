// переменная для хранения ссылки на объект XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// переменная для хранения адреса удаленного сервера
var serverAddress = "ajax.php";
// если установлено значение true, выводятся подробные сообщения об ошибках
var showErrors = true;
// инициализировать кэш запросов
var cache = new Array();

// создает экземпляр объекта XMLHttpRequest
function createXmlHttpRequestObject() 
{
    // переменная для хранения ссылки на объект XMLHttpRequest
    var xmlHttp;
    // эта часть кода должна работать во всех броузерах, за исключением 
    // IE6 и более старых его версий
    try
    {
        // попытаться создать объект XMLHttpRequest
        xmlHttp = new XMLHttpRequest();
    }
    catch(e)
    {
        // предполагается, что в качестве броузера используется
        // IE6 или более старая его версия
        var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                        "MSXML2.XMLHTTP.5.0",
                                        "MSXML2.XMLHTTP.4.0",
                                        "MSXML2.XMLHTTP.3.0",
                                        "MSXML2.XMLHTTP",
                                        "Microsoft.XMLHTTP");
        // попробовать все возможные prog id, 
        // пока какая либо попытка не увенчается успехом
        for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
        {
            try 
            { 
            // попытаться создать объект XMLHttpRequest 
            xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
            } 
            catch (e) {} //игнорировать возможные ошибки
        }
    }
    // вернуть созданный объект или вывести сообщение об ошибке
    if (!xmlHttp)
       displayError("Ошибка создания обьекта XMLHttpRequest.");
    else 
       return xmlHttp;
}

 // функция выводит сообщение об ошибке
function displayError($message)
{
    // игнорировать ошибку, если в showErrors находится значение false
    if (showErrors)
    {
        // отключить вывод сообщений об ошибках
        showErrors = false;
        // вывести сообщение об ошибке
 
        alert("Обнаружена ошибка: \n" + $message);
        // повторная проверка не ранее, чем через 10 секунд
        setTimeout("validate();", 10000);
    }
}

//  функция выполняет проверку любого поля формы при регистрации
function validate(inputValue, fieldID)
{
    // продолжать только если в xmlHttp не пустая ссылка 
    if (xmlHttp)
    {
        // если был принят не пустой аргумент, помещаем его в кэш в виде
        // строки запроса, который будет послан серверу для проверки
        if (fieldID)
        {
        // преобразовать значения, в форму, которая безопасно 
        // может быть включена в строку запроса HTTP
        inputValue = encodeURIComponent(inputValue);
        fieldID = encodeURIComponent(fieldID);
        // добавить значения в очередь
        cache.push("inputValue=" + inputValue + "&fieldID=" + fieldID);
        }
        // попытаться установить соединение с сервером
        try
        {
             // продолжать только если объект XMLHttpRequest не занят
             // и кэш не пуст
            if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0)&& cache.length > 0)
            {
                 // извлечь новый набор параметров из кэша
                var cacheEntry = cache.shift();
                // послать запрос серверу для проверки извлеченных данных
                xmlHttp.open("POST", serverAddress, true);
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlHttp.onreadystatechange = handleRequestStateChange;
                xmlHttp.send(cacheEntry);
            }
        }
        catch (e)
        {
            // вывести сообщение об ошибке при неудачной попытке установить соединение с сервером
            displayError(e.toString());
        }
    }
}

// функция обслуживает ответы HTTP 
function handleRequestStateChange() 
{
    // когда readyState = 4, мы можем прочитать ответ сервера
    if (xmlHttp.readyState == 4) 
    {
        // продолжать, только если статус HTTP равен «OK»
        if (xmlHttp.status == 200) 
        {
            try
            {
                // прочитать ответ, полученный от сервера
                readResponse();
            }
            catch(e)
            {
                 // вывести сообщение об ошибке
                 displayError(e.toString());
            }
        }
        else
        {
            // вывести сообщение об ошибке
            displayError(xmlHttp.statusText);
        }
    }
}

// читает ответ сервера
function readResponse()
{
    // получить ответ сервера
    var response = xmlHttp.responseText;
    // ошибка сервера?
    if (response.indexOf("ERRNO") >= 0 
        || response.indexOf("error:") >= 0
        || response.length == 0)
    throw(response.length == 0 ? "Server error." : response);
    responseXml = xmlHttp.responseXML;
    xmlDoc = responseXml.documentElement;
    result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
    fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
    message = document.getElementById(fieldID + "Failed");
    message.className = (result == "0") ? "error" : "hidden";
    setTimeout("validate();", 500);
}






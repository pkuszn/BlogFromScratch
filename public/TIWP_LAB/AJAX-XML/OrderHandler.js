var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
    var xmlHttp;
    if(window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }
    else{
        xmlHttp = new ActiveXObject("Microsoft.XMLTYPE");
    }
    return xmlHttp;
}

function process(){
    if(xmlHttp){
        try{
            xmlHttp.open("GET", "zamowinie.xml", true);
            xmlHttp.onreadystatechange = handleStateChange;
            xmlHttp.send(null);
        }
        catch(e){
            alert(e.toString());
        }
    }
}


function handleStateChange(){
    if(xmlHttp.readyState === 4){
        if(xmlHttp.status === 200){
            try{
                handleResponse();
            }
            catch(e){
                alert(e.toString());
            }
        }
        else{
            alert(xmlHttp.statusText);
        }
    }
}


function handleResponse(){
    var xmlResponse = xmlHttp.responseXML;
    root = xmlResponse.documentElement;
    osobas = root.getElementsByTagName('osoba');
    ciastos = root.getElementsByTagName('ciasto');
    wielkoscs = root.getElementsByTagName('wielkosc');
    skladnik1s = root.getElementsByTagName('skladnik1');
    skladnik2s = root.getElementsByTagName('skladnik2');
    skladnik3s = root.getElementsByTagName('skladnik3');
    soss = root.getElementsByTagName('sos');
    cenas = root.getElementsByTagName('cena');
    var table = "    <tr>\n" +
        "            <th>Nr</th>\n" +
        "            <th>Osoba</th>\n" +
        "            <th>Ciasto</th>\n" +
        "            <th>Skladnik1</th>\n" +
        "            <th>Skladnik2</th>\n" +
        "            <th>Skladnik3</th>\n" +
        "            <th>Sos</th>\n" +
        "        </tr>\n";

    var table = "<tr><th>Osoba</th><th>ciasto</th><th>wielkosc</th><th>Skladnik1</th><th>Skladnik2</th><th>Skladnik3</th><th>sos</th></tr>";
    var cena ="";
    var sum = 0;
    var pieczarkis= 0;
    var kukurydzas= 0;
    var sers= 0;
    var wolowinas = 0;
    var salamis = 0;

    for(var i = 0; i<osobas.length; i++){
        table += "<tr>" + "<td>" + osobas.item(i).firstChild.textContent + "</td>" +"<td>" + ciastos.item(i).firstChild.textContent + "</td>" + "<td>" + wielkoscs.item(i).firstChild.textContent + "</td>" +"<td>" + skladnik1s.item(i).firstChild.textContent + "</td>" + "<td>" + skladnik2s.item(i).firstChild.textContent + "</td>" + "<td>" + skladnik3s.item(i).firstChild.textContent + "</td>" + "<td>" + soss.item(i).firstChild.textContent + "</td>" + "</tr>";
        cena += "Cena: " + cenas.item(i).firstChild.textContent+ "<br/>";
        sum += parseInt(cenas.item(i).firstChild.nodeValue);
        if((table.indexOf("Pieczarki") !== -1)){
            pieczarkis++;
        }
        if((table.indexOf("Ser") !== -1)){
            sers++;
        }
       if((table.indexOf("Wolowina") !== -1)){
            wolowinas++;
        }
       if((table.indexOf("Kukurydza") !== -1)){
            kukurydzas++;
        }

    }

    var theD = document.getElementById("theD");
    theD.innerHTML = table;

    var cenahtml = document.getElementById("cena");
    cenahtml.innerHTML = cena;

    var suma = document.getElementById("suma");
    suma.innerHTML = "suma: " + sum;

    //Correct statements, sums of ingredients aren't properly counted
    
    var pieczarkihtml = document.getElementById("pieczarki");
    pieczarkihtml.innerHTML = "Pieczary: " + pieczarkis.toString();
    var serhtml = document.getElementById("ser");
    serhtml.innerHTML = "Ser: " + sers.toString();
    var wolowinahtml = document.getElementById("wolowina");
    wolowinahtml.innerHTML = "Wolowina: " +  wolowinas.toString();
    var kukurydzahtml = document.getElementById("kukurydza");
    kukurydzahtml.innerHTML = "Kukurydza: " + kukurydzas.toString();

}




/*
function handleResponse() {
    var xmlResponse = xmlHttp.responseXML;
    root = xmlResponse.documentElement;
    names = root.getElementsByTagName('name');
    ssns = root.getElementsByTagName('ssn');

    var stuff="";
    for(var i = 0; i<names.length; i++){
        stuff += names.item(i).firstChild.textContent + " - " + ssns.item(i).firstChild.textContent + "<br/>";
        console.log(stuff);
    }

    var theD = document.getElementById("theD");
    theD.innerHTML = stuff;


}

*/


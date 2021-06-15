function selectForm(){
    clearForm()
    if (document.getElementById("select").value=="mandaty")
        mandaty()
    else
        osoby()
    submit()
}
function createinput(type,placeholder,name,value= ''){
    var input = document.createElement("input");
    input.setAttribute('type', type);
    input.setAttribute('placeholder', placeholder);
    input.setAttribute('name', name);
    input.setAttribute('value', value);
    var parent = document.getElementById("selectForm");
    parent.appendChild(input);
}
function mandaty(){
    createinput('text','powód mandatu','powod')
}
function osoby(){
    createinput('text','imie','imie')
    createinput('text','nazwisko','nazwisko')
    createinput('text','miasto','miasto')
}
function submit(){
    createinput('submit','','name','wyszukaj')
}
function clearForm(){
    var node= document.getElementById("selectForm");
node.querySelectorAll('input').forEach(n => n.remove());
}
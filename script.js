const flexRadioDefault1 = document.getElementById('flexRadioDefault1');
const flexRadioDefault2 = document.getElementById('flexRadioDefault2');
const flexRadioDefault3 = document.getElementById('flexRadioDefault3');
const flexRadioDefault4 = document.getElementById('flexRadioDefault4');

function nova1(){
    flexRadioDefault1.classList.replace('btn-info','btn-success');
    flexRadioDefault2.classList.remove('btn-success');
    flexRadioDefault2.classList.add('btn-info')
}

function virarLado1(){
    flexRadioDefault2.classList.replace('btn-info','btn-success');
    flexRadioDefault1.classList.remove('btn-success');
    flexRadioDefault1.classList.add('btn-info')
}

function nova2(){
    flexRadioDefault3.classList.replace('btn-info','btn-success');
    flexRadioDefault4.classList.remove('btn-success');
    flexRadioDefault4.classList.add('btn-info')
}

function virarLado2(){
    flexRadioDefault4.classList.replace('btn-info','btn-success');
    flexRadioDefault3.classList.remove('btn-success');
    flexRadioDefault3.classList.add('btn-info')
}
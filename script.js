let x, y, r = '';

function pressX(id){
    x = document.getElementById(id).value;
}

function check(){

    let fail = false;
    let choose = false;

    for(let i=-3 ;i<=5; i++) {
        if (document.getElementById(i.toString()).checked) {
            choose = true;
            break;
        }
    }
    if (!choose) fail = 'Выберите X \n';

    y = document.getElementById('Y').value.trim();
    if (y === ''){
        if(!fail) fail = 'Введите Y \n'; else fail += 'Введите Y \n';
        choose = false;
    }else {
        if (!/^(-?\d+)([.]\d+)?$/.test(y)) {
            if(!fail) fail = 'Некорректный ввод Y \n'; else fail += 'Некорректный ввод Y \n';
            choose = false;
        } else if (y <= -5 || y >= 3) {
            if(!fail) fail = 'Y вне диапозона \n'; else fail +='Y вне диапозона \n';
            choose = false;
        }
    }

    r = document.getElementById('R').value.trim();
    if (r === ''){
        if(!fail) fail = 'Введите R \n'; else fail += 'Введите R \n';
        choose = false;
    }else {
        if (!/^(-?\d+)([.]\d+)?$/.test(r)) {
                if (!fail) fail = 'Некорректный ввод R \n'; else fail += 'Некорректный ввод R \n';
                choose = false;

        } else if (r <= 2 || r >= 5) {
            if(!fail) fail = 'R вне диапозона \n'; else fail += 'R вне диапозона \n';
            choose = false;
        }
    }

    if (fail){
        alert(fail);
        return false;
    } return choose;
}

function ask() {
    if(check())
    {
        jQuery("#resultTable tr").remove();
        jQuery.get('check.php', {'X':x, 'Y':y, 'R':r}, function (data) {document.getElementById('resultTable').innerHTML+=data;});
    }
}

function reset(){
    for (let i=-3 ;i<=5; i++) document.getElementById(i.toString()).checked = false;
    document.getElementById('R').value = '';
    document.getElementById('Y').value = '';
}
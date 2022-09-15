function postme(theUrl) {
    var n = document.getElementById('n').value;
    if (n == null) { alert('n null'); }
    var p = document.getElementById('p').value;
    if (p == null) { alert('p null'); }
    var s = document.getElementById('s').value;
    if (s == null) { alert('s null'); }

    var f = new FormData();
    f.set('n', n);
    f.set('p', p);
    f.set('s', s);
    // Make the call - Asynchronous way
    let xmlHttpReq = new XMLHttpRequest();
    // xmlHttpReq.callback = update_div('custo', 'Call back');
    xmlHttpReq.onload   = update_div('custo', 'On Load '+n+' '+p+' '+s);
    xmlHttpReq.onerror  = () => update_div('custo', 'On Error 1');
    xmlHttpReq.open("POST", theUrl, true);
    xmlHttpReq.send(f);
    return 0;
}

function update_div(div_name, data) {
    document.getElementById(div_name).innerHTML = data;
    return 0;
}
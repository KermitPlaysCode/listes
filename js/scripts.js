function update_div(div_name, data) {
    document.getElementById(div_name).innerHTML = data;
    return 0;
}

// Matrix to tell what script to call for which action
const action_to_script = {
    'allow_one': 'update_acces.php',
    'deny_one': 'update_acces.php',
    'allow_all': 'update_acces.php',
    'deny_all': 'update_acces.php',
    'adm_add': 'update_admin.php',
    'adm_del': 'update_admin.php',
    'adm_pwd': 'update_admin.php',
    'list_add': 'update_list.php',
    'list_del': 'update_list.php',
    'list_edit': 'update_list.php',
}

const script_to_refresh_script = {
    'update_list.php': ['data/input_liste.div.php', 'input_liste'],
    'update_acces.php': ['data/input_acces.div.php', 'input_acces'],
    'update_admin.php': ['data/input_admin.div.php', 'input_admin'],
}

// Matrix to tell what variables must be collected for each script
const script_to_items = {
    'update_acces.php': [ 'c_list_name', 'c_user_name' ],
    'update_admin.php': [ 'a_user_name', 'a_user_pass' ],
    'update_list.php': [ 'l_list_name', 'l_list_name_new'],
}

function do_action(action_name) {
    // Gather values and prepare URL
    script_name = action_to_script[action_name];
    theUrl = script_name + "?act=" + encodeURIComponent(action_name);
    elem_id = script_to_items[script_name];
    for (id of elem_id) {
        theUrl = theUrl + '&' + id + '=' + encodeURIComponent(document.getElementById(id).value);
    }
    // Make the call - Asynchronous way
    let xmlHttpReq = new XMLHttpRequest();
    xmlHttpReq.callback = () => { update_div('console', "CB<br>"+xmlHttpReq.responseText); }
    xmlHttpReq.onload =   () => { update_div('console', "OK<br>"+xmlHttpReq.responseText); update_data(action_name); }
    xmlHttpReq.onerror =  () => { update_div('console', "ERROR<br>"+xmlHttpReq.responseText); }
    xmlHttpReq.open("GET", theUrl, true);
    xmlHttpReq.send(null);
    return 0;
}

function update_data(action_name) {
    // Gather values and prepare URL
    action_script = action_to_script[action_name];
    refresh_script = script_to_refresh_script[action_script][0];
    refresh_div = script_to_refresh_script[action_script][1];
    theUrl = refresh_script;
    // Make the call - Asynchronous way
    let xmlHttpReq = new XMLHttpRequest();
    xmlHttpReq.callback = () => { update_div(refresh_div, xmlHttpReq.responseText); }
    xmlHttpReq.onload =   () => { update_div(refresh_div, xmlHttpReq.responseText); }
    xmlHttpReq.onerror =  () => { update_div(refresh_div, "ERROR<br>"+xmlHttpReq.responseText); }
    xmlHttpReq.open("GET", theUrl, true);
    xmlHttpReq.send(null);
    return 0;
}

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
    'list_edit': 'update_items.php',
    'item_add': 'update_items.php',
    'item_del': 'update_items.php',
    'item_edit': 'update_items.php',
    'item_refresh': 'update_items.php'
}

const script_to_infos = {
    // script name called for action => MANY INFO
    // 'script_name.pHp: [
    //   - script that will provide refreshed data
    //   - div where data to place
    //   - array of variables to gather on the page
    //   - array of variables to pass to refreshed script
    //  ]
    'update_list.php': [
        'data/input_liste.div.php',
        'input_liste',
        [ 'l_list_name', 'l_list_name_new'],
        []
    ],
    'update_acces.php': [
        'data/input_acces.div.php',
        'input_acces',
        [ 'c_list_name', 'c_user_name' ],
        []
    ],
    'update_admin.php': [
        'data/input_admin.div.php',
        'input_admin',
        [ 'a_user_name', 'a_user_pass' ],
        []
    ],
    'update_items.php': [
        'data/liste.div.php',
        'liste',
        [ 'e_list_name', 'e_new_content', 'e_user_name', 'l_list_name', 'item_id'],
        [ 'e_list_name' ]
    ]
}

const script_to_items = {
}

function do_action(action_name) {
    // Gather values and prepare URL
    script_name = action_to_script[action_name];
    theUrl = script_name + "?act=" + encodeURIComponent(action_name);
    elem_id = script_to_infos[script_name][2];
    for (id of elem_id) {
        var elem = document.getElementById(id);
        if (elem != null) {
            theUrl = theUrl + '&' + id + '=' + encodeURIComponent(elem.value);
        }
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
    refresh_script = script_to_infos[action_script][0];
    refresh_div = script_to_infos[action_script][1];
    parameter = script_to_infos[action_script][3];
    uri_parameters = '';
    if (parameter.length > 0 ) {
        uri_parameters = '?';
        sep = '';
        for (p of parameter) {
            var elem = document.getElementById(p)
            if (elem != null) {
                uri_parameters = uri_parameters + sep + p + '=' + encodeURIComponent(elem.value);
                sep = '&';
            }
        }
    }
    theUrl = refresh_script + uri_parameters;
    // Make the call - Asynchronous way
    let xmlHttpReq = new XMLHttpRequest();
    xmlHttpReq.callback = () => { update_div(refresh_div, xmlHttpReq.responseText); }
    xmlHttpReq.onload =   () => { update_div(refresh_div, xmlHttpReq.responseText); }
    xmlHttpReq.onerror =  () => { update_div(refresh_div, "ERROR<br>"+xmlHttpReq.responseText); }
    xmlHttpReq.open("GET", theUrl, true);
    xmlHttpReq.send(null);
    return 0;
}

// Put the value from a select into a test box
function update_text(list_id, inputtext_id) {
    document.getElementById(inputtext_id).value = document.getElementById(list_id).value;
}

// Update current list to edit
function set_current_list() {
    var elem = document.getElementById('e_list_name');
    var elem2 = document.getElementById('l_list_name');
    if (elem == null) alert("e_list_name pas trouvé");
    else if (elem2 == null) alert("l_list_name pas trouvé");
    else elem.value = elem2.value;
    do_action('item_refresh');
    return elem.value;
}

// Keep not of selected item to delete
function set_item_id(item_id) {
    var elem = document.getElementById('item_id');
    if (elem != null) elem.value = item_id;
    else alert("item_id pas trouvé")
    return elem.value;
}

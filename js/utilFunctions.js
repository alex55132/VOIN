function getUrlParameters() {
    let searchString = window.location.search;
    let variables = {}
    searchString = searchString.split("?")[1];
    if(searchString === undefined) {
        variables = null;
    } else {
        searchString = searchString.split("&");
        for(let i = 0; i < searchString.length; i++) {
            let pair = searchString[i].split("=");
            variables[pair[0]] = pair[1];
        }
    }
    return variables;
}
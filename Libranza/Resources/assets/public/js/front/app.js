function reloadUrl(url, type) {
    if (type == 1) {
        window.location.href = url;
    } else {
        window.open(url);
    }
}
function confirmAction(callback, text = 'Are you sure?') {
    let r = confirm(text);
    if (r === true) {
        callback();
    }
}

function confirmDelete() {
    let response = confirm("Tem certeza que deseja apagar a publicação?");
    if (response == false) {
        return false;
    }
}
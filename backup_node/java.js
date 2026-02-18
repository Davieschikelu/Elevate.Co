async function handleLogin() {
    this.isLoading = true;
    const response = await fetch('/api/login', {
        method: 'POST',
        body: JSON.stringify(formData)
    });
    // handle success...
}
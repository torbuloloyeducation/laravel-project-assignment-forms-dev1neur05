# Reflection Answers

1. **GET vs POST**
   GET retrieves data and shows parameters in the URL.
   POST sends data in the request body, used for submitting forms securely.

2. **Why @csrf?**
   It generates a hidden security token to protect against
   Cross-Site Request Forgery attacks. Laravel rejects any
   POST request without a valid token.

3. **What is session used for here?**
   Session temporarily stores the list of emails on the server
   between requests, since HTTP is stateless and data would
   otherwise be lost after each page load.

4. **What happens if session is cleared?**
   All stored emails disappear since they only live in the
   session — there is no database saving them permanently.
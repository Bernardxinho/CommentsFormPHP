# Feedback Form Application

## Objective

Create a simple feedback form that collects user input based on the specified fields below. Upon submission, the data should be:
1. **Validated** to ensure the input meets the requirements.
2. **Sanitized** to prevent potential security issues.
3. **Stored** in a database (JSON file for simplicity).
4. **Displayed** in a listing below the form.

---

## Fields and Validation Rules

1. **Full Name**:
   - Must contain a first and last name (validation does not check the names themselves, only the presence of two words).

2. **Email**:
   - Must be a valid email address in the correct format.

3. **Rating**:
   - Must be a number between 1 and 5.

4. **Message**:
   - Must be at least 15 characters long (excluding leading and trailing spaces; UTF-8 encoding should be considered for length validation).

---

## Layout Example

### Form Fields:
- **Full Name**
- **Email**
- **Rating** (1-5)
- **Message**

---
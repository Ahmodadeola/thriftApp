const form = document.querySelector("form");
const validateFields = () => {
  let isValid = true;
  let formData = getFormValues();
  const { email, password } = formData;
  if (!email) {
    addErrorMessage("Email is required", "div.email");
    isValid = false;
  }
  if (!password) {
    addErrorMessage("Password is required", "div.password");
    isValid = false;
  } else if (password.length < 6) {
    addErrorMessage("Password must be min of 6 characters", "div.password");
    isValid = false;
  }

  return isValid;
};

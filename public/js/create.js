// get the admin element in the DOM
const isAdminEl = document.querySelector("input[name=isAdmin]");
const participateEl = document.querySelector("input[name=doesThrift]");

const passwordDiv = document.querySelector("#password");
const participateDiv = document.querySelector("#doesThrift");
const groupsDiv = document.querySelector("#groups");

const groupsWrapper = document.querySelector("#groups-wrapper");
const groupValueInput = document.querySelector("#selected-groups");

const getFormValues = () => {
  let formData = new FormData(form);
  formData = Object.fromEntries(formData.entries());
  return formData;
};

// toggle password fields and participate checkbox when isAdmin checkbox is switched
const handleAdminSwitch = (e) => {
  const adminvalue = isAdminEl.checked;

  if (adminvalue) {
    passwordDiv.classList.remove("hidden");
    participateDiv.classList.remove("hidden");
    groupsDiv.classList.add("hidden");
  } else {
    participateDiv.classList.add("hidden");
    passwordDiv.classList.add("hidden");
    groupsDiv.classList.remove("hidden");
  }
};

const handleParticipateSwitch = (e) => {
  const participateValue = participateEl.checked;
  if (participateValue) {
    groupsDiv.classList.remove("hidden");
  } else {
    groupsDiv.classList.add("hidden");
  }
};

const handleGroupSelect = () => {
  let formData = getFormValues();
  const selectedGroups = Object.entries(formData).filter(([key, value]) =>
    key.toLowerCase().startsWith("group")
  );
  const values = selectedGroups.map(([key, value]) => value);
  console.log({ values });

  groupValueInput.value = values;
};

isAdminEl.addEventListener("change", handleAdminSwitch);
participateEl.addEventListener("change", handleParticipateSwitch);
groupsWrapper.addEventListener("click", handleGroupSelect);

const firstNameDiv = document.querySelector(".firstName");
const form = document.querySelector("form");

const addErrorMessage = (message = "", parentSelector) => {
  const parentElement = document.querySelector(parentSelector);
  const isSpan = parentElement.lastChild.localName === "span";
  if (isSpan) {
    parentElement.removeChild(parentElement.lastChild);
  }
  const errorSpan = document.createElement("span");
  errorSpan.innerText = message;
  parentElement.appendChild(errorSpan);
};

const validateFields = () => {
  let isValid = true;
  let formData = getFormValues();
  const {
    firstName,
    lastName,
    email,
    password,
    confirmPassword,
    isAdmin,
    doesThrift,
    groups,
  } = formData;
  // console.log({ formData });
  if (!firstName) {
    addErrorMessage("First Name is required", ".firstName");
    isValid = false;
  }
  if (!lastName) {
    addErrorMessage("Last Name is required", ".lastName");
    isValid = false;
  }
  if (!email) {
    addErrorMessage("Email is required", ".email");
    isValid = false;
  }
  if (isAdmin === "true") {
    if (!password) {
      addErrorMessage("Password is required", ".input-div#password");
      isValid = false;
    } else if (password.length < 7) {
      addErrorMessage(
        "Password must be min of 6 characters",
        ".input-div#password"
      );
    }
    if (password !== confirmPassword) {
      addErrorMessage(
        "password and confirm password values must match",
        "#confirmPassword"
      );
      isValid = false;
    }
  }
  if (
    !groups &&
    (!isAdmin !== "true" || (isAdmin === "true" && doesThrift === "true"))
  ) {
    if (!groups) {
      addErrorMessage("Select a group", "#groups");
      isValid = false;
    }
  }
  return isValid;
};

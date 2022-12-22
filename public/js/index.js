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

const getFormValues = (form) => {
  let formData = new FormData(form);
  formData = Object.fromEntries(formData.entries());
  return formData;
};

const searchForm = document.querySelector("#search");
const groupsWrapper = document.querySelector("#groups-wrapper");
const groupValueInput = document.querySelector("#selected-groups");
const memberInput = document.querySelector("#selected-member");

const handleGroupSelect = () => {
  let formData = getFormValues(form);
  const selectedGroups = Object.entries(formData).filter(([key, value]) =>
    key.toLowerCase().startsWith("group-")
  );
  const values = selectedGroups.map(([key, value]) => value);

  groupValueInput.value = values;
};

const handleMemberSelect = () => {
  const value = memberSelect.value;
  console.log({ value });
  memberInput.value = value;
};

groupsWrapper.addEventListener("click", handleGroupSelect);

const form = document.querySelector("#thriftpay");
const validateFields = () => {
  let isValid = true;
  let formData = getFormValues(form);
  const { member, groups } = formData;
  console.log({ formData });

  // assign individul form input errors
  if (!member) {
    // addErrorMessage("Search for members and select option", "#member");
    isValid = false;
  }
  if (!groups) {
    // addErrorMessage("Select a group", "#groups-wrapper");
    isValid = false;
  }

  return isValid;
};

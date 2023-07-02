/**
 * Check form values has changed or not
 * @param beforeValues
 * @param afterValuef
 * @returns boolean
 */
export const checkValuesIsChanged = (beforeValues, afterValues) => {
    for (const property in afterValues) {
        if (beforeValues[property] !== afterValues[property]) return true;
    }
    return false;
};

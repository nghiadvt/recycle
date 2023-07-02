import { useEffect, useState } from "react";
/**
 * debounced function hook for type search text
 * @param value
 * @param delay
 * @returns
 */
const useDebounce = (value: string, delay: number) => {
    const [newValue, setNewValue] = useState<string>(value);
    useEffect(() => {
        const timer = setTimeout(() => {
            setNewValue(value);
        }, delay);

        return () => {
            clearTimeout(timer);
        };
    }, [value, delay]);
    return newValue;
};

export default useDebounce;

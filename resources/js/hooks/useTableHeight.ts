import { useEffect, useState } from "react";

const useTableHeight = () => {
    const [windowHeight, setWindowHeight] = useState<number>(
        window.innerHeight
    );

    useEffect(() => {
        const handleWindowResize = () => {
            setWindowHeight(window.innerHeight);
        };

        window.addEventListener("resize", handleWindowResize);

        return () => {
            window.removeEventListener("resize", handleWindowResize);
        };
    }, []);

    useEffect(() => {
        const tableBody =
            document.querySelector<HTMLElement>(".ant-table-body")!;
        tableBody.style.maxHeight = `${windowHeight - 361}px`;
        tableBody.style.overflow = "scroll";
    }, [windowHeight]);
};

export default useTableHeight;

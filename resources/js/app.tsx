import { createRoot } from "react-dom/client";
import {
    BrowserRouter as Router,
    Routes,
    Route,
    Navigate,
} from "react-router-dom";
import { Fragment } from "react";

import { publicRoutes } from "./routes";
import RootProvider from "./contexts/RootProvider";

function App() {
    return (
        <Router>
            <Routes>
                {publicRoutes.map((route, index) => {
                    const Page = route.element;
                    const Layout = route.layout ?? Fragment;
                    return (
                        <Route
                            key={index}
                            path={route.path}
                            element={
                                <Layout>
                                    <Page />
                                </Layout>
                            }
                        />
                    );
                })}
                <Route path="*" element={<Navigate to="/login" replace />} />
            </Routes>
        </Router>
    );
}

const root = createRoot(document.getElementById("root")!);

root.render(
    <RootProvider>
        <App />
    </RootProvider>
);

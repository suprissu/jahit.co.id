import React from "react";
import { ChakraProvider } from "@chakra-ui/react";
import ReactDOM from "react-dom";
import ContextProvider, { useProps } from "@utils/Context";
import ProjectDetail from "@components/project/ProjectDetail";
import "semantic-ui-css/semantic.min.css";

export default function ProjectDetailPage() {
    const { project } = useProps();

    return (
        <ChakraProvider>
            <ProjectDetail data={project[0]} />
        </ChakraProvider>
    );
}

const ProjectDetailPageApp = props => {
    return (
        <ContextProvider {...props}>
            <ProjectDetailPage />
        </ContextProvider>
    );
};

const root = document.getElementById("project-detail");
if (root) {
    const props = window.props;
    ReactDOM.render(<ProjectDetailPageApp {...props} />, root);
}

import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  // This is mainly for the production build to ensure assets are linked correctly
  base: "/react-app/", // Match the subdirectory where your React app is served
});

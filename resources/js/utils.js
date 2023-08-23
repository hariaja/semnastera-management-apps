export function processPermission(permissionName) {
    const parts = permissionName.split(".");
    const leftPart = parts[0];
    const rightPart = parts[1];
    const translatedName = translations[leftPart][rightPart];
    return translatedName;
}

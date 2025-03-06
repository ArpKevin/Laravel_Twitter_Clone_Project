using System.Collections;
using UnityEngine;
using UnityEngine.Networking;
using System.Text;
using System;

public class DB_Manager : MonoBehaviour
{
    private readonly static string API_URL = "http://localhost:8000/api"; // Default Laravel development server URL
    private static string authToken;

    [Serializable]
    private class LoginResponse
    {
        public string token;
        public UserData user;
    }

    [Serializable]
    public class UserData
    {
        public int id;
        public string name;
        public string email;
        public string bio;
        public string image_url;
    }

    [Serializable]
    private class RegisterRequest
    {
        public string name;
        public string email;
        public string password;
        public string password_confirmation;
    }

    [Serializable]
    private class LoginRequest
    {
        public string email;
        public string password;
    }

    [Serializable]
    private class ErrorResponse
    {
        public string message;
        public ErrorDetails errors;
    }

    [Serializable]
    private class ErrorDetails
    {
        public string[] email;
        public string[] password;
        public string[] name;
    }

    private class JsonHelper
    {
        public static T ParseJson<T>(string json)
        {
            try
            {
                // Handle Laravel's validation error format
                if (json.Contains("\"message\":\"The given data was invalid.\""))
                {
                    // Extract the first error message from the errors object
                    int errorsStart = json.IndexOf("\"errors\":{");
                    if (errorsStart != -1)
                    {
                        int firstErrorStart = json.IndexOf("[\"", errorsStart);
                        if (firstErrorStart != -1)
                        {
                            int firstErrorEnd = json.IndexOf("\"]", firstErrorStart);
                            if (firstErrorEnd != -1)
                            {
                                string errorMessage = json.Substring(firstErrorStart + 2, firstErrorEnd - (firstErrorStart + 2));
                                return JsonUtility.FromJson<T>(json);
                            }
                        }
                    }
                }
                
                return JsonUtility.FromJson<T>(json);
            }
            catch (Exception e)
            {
                Debug.LogError($"JSON Parse Error: {e.Message}\nJSON: {json}");
                throw;
            }
        }
    }

    public static string GetAuthToken()
    {
        return authToken;
    }

    public static IEnumerator RegisterUser(string email, string username, string password, System.Action<bool, string> callback)
    {
        string url = $"{API_URL}/register";

        var registerData = new RegisterRequest
        {
            name = username,
            email = email,
            password = password,
            password_confirmation = password
        };

        string jsonData = JsonUtility.ToJson(registerData);
        yield return SendPostRequest(url, jsonData, (success, response) =>
        {
            if (success)
            {
                try
                {
                    var loginResponse = JsonHelper.ParseJson<LoginResponse>(response);
                    authToken = loginResponse.token;
                    callback(true, loginResponse.user.name);
                }
                catch (Exception e)
                {
                    Debug.LogError($"Failed to parse registration response: {e.Message}\nResponse: {response}");
                    callback(false, GetErrorMessage(response));
                }
            }
            else
            {
                callback(false, GetErrorMessage(response));
            }
        });
    }

    public static IEnumerator LoginUser(string email, string password, System.Action<bool, string> callback)
    {
        string url = $"{API_URL}/login";

        var loginData = new LoginRequest
        {
            email = email,
            password = password
        };

        string jsonData = JsonUtility.ToJson(loginData);
        yield return SendPostRequest(url, jsonData, (success, response) =>
        {
            if (success)
            {
                try
                {
                    var loginResponse = JsonHelper.ParseJson<LoginResponse>(response);
                    authToken = loginResponse.token;
                    callback(true, loginResponse.user.name);
                }
                catch (Exception e)
                {
                    Debug.LogError($"Failed to parse login response: {e.Message}\nResponse: {response}");
                    callback(false, GetErrorMessage(response));
                }
            }
            else
            {
                callback(false, GetErrorMessage(response));
            }
        });
    }

    private static string GetErrorMessage(string response)
    {
        try
        {
            // Try to parse as a validation error response
            if (response.Contains("\"message\":\"The given data was invalid.\""))
            {
                int errorsStart = response.IndexOf("\"errors\":{");
                if (errorsStart != -1)
                {
                    int firstErrorStart = response.IndexOf("[\"", errorsStart);
                    if (firstErrorStart != -1)
                    {
                        int firstErrorEnd = response.IndexOf("\"]", firstErrorStart);
                        if (firstErrorEnd != -1)
                        {
                            return response.Substring(firstErrorStart + 2, firstErrorEnd - (firstErrorStart + 2));
                        }
                    }
                }
            }

            // Try to parse as a general error message
            if (response.Contains("\"message\":"))
            {
                int messageStart = response.IndexOf("\"message\":\"") + 11;
                int messageEnd = response.IndexOf("\"", messageStart);
                if (messageStart != -1 && messageEnd != -1)
                {
                    return response.Substring(messageStart, messageEnd - messageStart);
                }
            }

            return "An error occurred. Please try again.";
        }
        catch (Exception e)
        {
            Debug.LogError($"Error parsing error message: {e.Message}\nResponse: {response}");
            return "An unexpected error occurred.";
        }
    }

    private static IEnumerator SendPostRequest(string url, string jsonData, System.Action<bool, string> callback)
    {
        using (UnityWebRequest req = new UnityWebRequest(url, "POST"))
        {
            byte[] bodyRaw = Encoding.UTF8.GetBytes(jsonData);
            req.uploadHandler = new UploadHandlerRaw(bodyRaw);
            req.downloadHandler = new DownloadHandlerBuffer();
            req.SetRequestHeader("Content-Type", "application/json");
            req.SetRequestHeader("Accept", "application/json");
            
            if (!string.IsNullOrEmpty(authToken))
            {
                req.SetRequestHeader("Authorization", $"Bearer {authToken}");
            }

            yield return req.SendWebRequest();

            string responseText = req.downloadHandler.text;
            Debug.Log($"Response from {url}: {responseText}");

            if (req.result == UnityWebRequest.Result.Success)
            {
                callback(true, responseText);
            }
            else
            {
                callback(false, responseText);
            }
        }
    }

    private static IEnumerator SendGetRequest(string url, System.Action<bool, string> callback)
    {
        using (UnityWebRequest req = UnityWebRequest.Get(url))
        {
            if (!string.IsNullOrEmpty(authToken))
            {
                req.SetRequestHeader("Authorization", $"Bearer {authToken}");
            }
            req.SetRequestHeader("Accept", "application/json");

            yield return req.SendWebRequest();

            string responseText = req.downloadHandler.text;
            Debug.Log($"Response from {url}: {responseText}");

            if (req.result == UnityWebRequest.Result.Success)
            {
                callback(true, responseText);
            }
            else
            {
                callback(false, responseText);
            }
        }
    }
}

using System.Collections;
using TMPro;
using UnityEngine;
using UnityEngine.SceneManagement;

public class LoginManager : MonoBehaviour
{
    [Header("Login")]
    [SerializeField] TMP_InputField Log_Email;
    [SerializeField] TMP_InputField Log_Password;
    [SerializeField] TextMeshProUGUI ErrorText;

    private void Start()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }
    }

    public void OnLoginPressed()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }

        StartCoroutine(LoginUserCoroutine(Log_Email.text, Log_Password.text));
    }

    private IEnumerator LoginUserCoroutine(string email, string password)
    {
        yield return StartCoroutine(DB_Manager.LoginUser(email, password, (success, message) =>
        {
            if (success)
            {
                Debug.Log($"Successfully logged in as: {message}");
                SceneManager.LoadScene(3); // Make sure this scene index is correct for your main scene
            }
            else
            {
                ShowError(message);
            }
        }));
    }

    private void ShowError(string message)
    {
        if (ErrorText != null)
        {
            ErrorText.text = message;
        }
        Debug.LogError(message);
    }
}
